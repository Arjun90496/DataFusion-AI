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
    
    public function __construct(DataFusionService $fusionService)
    {
        $this->fusionService = $fusionService;
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

            // Log activity
            $user->logActivity(
                'data_fusion',
                "Generated a new data fusion snapshot with {$fusedData->sources_count} sources",
                'sparkles',
                'purple',
                route('fusion.show')
            );
            
            return back()->with('success', 'Data fusion completed successfully!');
            
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
}
