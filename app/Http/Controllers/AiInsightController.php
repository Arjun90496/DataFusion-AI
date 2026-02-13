<?php

namespace App\Http\Controllers;

use App\Models\FusedData;
use App\Services\AI\AiInsightService;
use Illuminate\Support\Facades\Auth;

/**
 * AiInsightController
 * 
 * Handles AI insight generation
 */
class AiInsightController extends Controller
{
    protected AiInsightService $aiService;
    
    public function __construct(AiInsightService $aiService)
    {
        $this->aiService = $aiService;
    }

    /**
     * Display a listing of user insights
     */
    public function index()
    {
        $user = Auth::user();
        $insights = \App\Models\AiInsight::where('user_id', $user->id)
            ->with('fusedData')
            ->latest()
            ->paginate(10);
            
        return view('insights.index', compact('insights'));
    }
    
    /**
     * Generate AI insights for the latest fusion data
     */
    public function generate()
    {
        $user = Auth::user();
        
        try {
            // Get latest fusion data
            $fusedData = FusedData::where('user_id', $user->id)
                ->latest('fused_at')
                ->first();
            
            if (!$fusedData) {
                return back()->with('error', 'No fusion data available. Please generate a fusion snapshot first.');
            }
            
            // Check if insights already exist for this fusion
            $existingInsight = \App\Models\AiInsight::where('fused_data_id', $fusedData->id)->first();
            
            if ($existingInsight) {
                return back()->with('info', 'Insights already generated for this fusion snapshot.');
            }
            
            // Generate insights
            $insight = $this->aiService->generateInsights($fusedData);

            // Log activity
            $user->logActivity(
                'insight_generated',
                "AI generated new insights from latest data fusion",
                'lightbulb',
                'purple'
            );
            
            return back()->with('success', 'AI insights generated successfully!');
            
        } catch (\Exception $e) {
            \Log::error('AI insight generation failed', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);
            
            return back()->with('error', 'Failed to generate insights: ' . $e->getMessage());
        }
    }
}
