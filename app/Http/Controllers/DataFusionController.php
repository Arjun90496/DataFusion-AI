<?php

namespace App\Http\Controllers;

use App\Services\DataFusion\DataFusionService;
use Illuminate\Support\Facades\Auth;

/**
 * DataFusionController
 * 
 * Handles fusion-related operations
 */
class DataFusionController extends Controller
{
    protected DataFusionService $fusionService;
    protected \App\Services\AI\AiInsightService $aiService;
    
    public function __construct(DataFusionService $fusionService, \App\Services\AI\AiInsightService $aiService)
    {
        $this->fusionService = $fusionService;
        $this->aiService = $aiService;
    }
    
    /**
     * Generate a new fusion snapshot
     */
    public function generate()
    {
        $user = Auth::user();
        
        try {
            $fusedData = $this->fusionService->fuse($user);
            
            if (!$fusedData) {
                return back()->with('error', 'No active API keys found. Please add and enable API keys first.');
            }

            // Phase 7: Automatically generate AI insights for the new fusion
            try {
                $this->aiService->generateInsights($fusedData);
            } catch (\Exception $aiEx) {
                \Log::error('Automatic AI insight generation failed', [
                    'fusion_id' => $fusedData->id,
                    'error' => $aiEx->getMessage(),
                ]);
                // We don't fail the whole request if AI fails, but we log it
            }

            // Log activity
            $user->logActivity(
                'data_fusion',
                "Generated new data fusion and AI insights from {$fusedData->sources_count} sources",
                'sparkles',
                'purple',
                route('fusion.show')
            );
            
            return back()->with('success', 'Data fusion and AI insights completed successfully!');
            
        } catch (\Exception $e) {
            \Log::error('Fusion generation failed', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);

            // Log error activity
            $user->logActivity(
                'fusion_error',
                "Failed to generate fusion: " . $e->getMessage(),
                'exclamation-triangle',
                'red'
            );
            
            return back()->with('error', 'Failed to generate fusion: ' . $e->getMessage());
        }
    }
    
    /**
     * View latest fusion data
     */
    public function show()
    {
        $user = Auth::user();
        
        $fusedData = \App\Models\FusedData::where('user_id', $user->id)
            ->latest('fused_at')
            ->first();
        
        // Load AI insights for this fusion data
        $aiInsight = $fusedData ? \App\Models\AiInsight::where('fused_data_id', $fusedData->id)->first() : null;
        
        return view('fusion.show', compact('fusedData', 'aiInsight'));
    }

    /**
     * Export fusion data in various formats
     */
    public function export($format = 'json')
    {
        $user = Auth::user();
        
        $fusedData = \App\Models\FusedData::where('user_id', $user->id)
            ->latest('fused_at')
            ->first();
        
        if (!$fusedData) {
            return back()->with('error', 'No fusion data to export. Generate a snapshot first.');
        }

        $filename = 'fusion_' . now()->format('Y-m-d_H-i-s');

        if ($format === 'json') {
            return response()->json($fusedData->fused_data)
                ->header('Content-Disposition', "attachment; filename={$filename}.json");
        } elseif ($format === 'csv') {
            $csv = $this->generateCSV($fusedData);
            return response($csv, 200)
                ->header('Content-Type', 'text/csv')
                ->header('Content-Disposition', "attachment; filename={$filename}.csv");
        } elseif ($format === 'pdf') {
            return $this->generatePDF($fusedData, $filename);
        }

        return back()->with('error', 'Invalid export format.');
    }

    private function generateCSV($fusedData)
    {
        $csv = "Field,Value\n";
        
        if ($fusedData->weather) {
            $csv .= "Weather Temperature," . ($fusedData->weather['current']['temperature'] ?? 'N/A') . "\n";
            $csv .= "Weather Description," . ($fusedData->weather['weather']['description'] ?? 'N/A') . "\n";
        }

        if ($fusedData->crypto) {
            foreach ($fusedData->crypto['data'] ?? [] as $coin) {
                $csv .= $coin['name'] . " Price,\$" . number_format($coin['current_price'] ?? 0, 2) . "\n";
            }
        }

        if ($fusedData->news) {
            foreach (array_slice($fusedData->news['articles'] ?? [], 0, 5) as $article) {
                $csv .= "News: " . ($article['title'] ?? 'N/A') . "," . ($article['source']['name'] ?? 'Unknown') . "\n";
            }
        }

        return $csv;
    }

    private function generatePDF($fusedData, $filename)
    {
        $html = '<html><head><title>Fusion Report</title></head><body>';
        $html .= '<h1>DataFusion Report</h1>';
        $html .= '<p>Generated: ' . now()->format('Y-m-d H:i:s') . '</p>';

        if ($fusedData->weather) {
            $html .= '<h2>Weather Data</h2>';
            $html .= '<p>Temperature: ' . ($fusedData->weather['current']['temperature'] ?? 'N/A') . '°C</p>';
            $html .= '<p>Description: ' . ($fusedData->weather['weather']['description'] ?? 'N/A') . '</p>';
        }

        if ($fusedData->crypto) {
            $html .= '<h2>Cryptocurrency Prices</h2>';
            foreach ($fusedData->crypto['data'] ?? [] as $coin) {
                $html .= '<p>' . $coin['name'] . ': $' . number_format($coin['current_price'] ?? 0, 2) . '</p>';
            }
        }

        if ($fusedData->news) {
            $html .= '<h2>Latest News</h2>';
            foreach (array_slice($fusedData->news['articles'] ?? [], 0, 5) as $article) {
                $html .= '<p><strong>' . ($article['title'] ?? 'N/A') . '</strong></p>';
                $html .= '<p><em>' . ($article['source']['name'] ?? 'Unknown') . '</em></p>';
            }
        }

        $html .= '</body></html>';

        // If you have a PDF library installed, use it:
        // return PDF::loadHTML($html)->download($filename . '.pdf');

        // For now, return as text file
        return response($html, 200)
            ->header('Content-Type', 'text/html')
            ->header('Content-Disposition', "attachment; filename={$filename}.html");
    }
}
