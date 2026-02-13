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
            
            return back()->with('success', 'Data fusion completed successfully!');
            
        } catch (\Exception $e) {
            \Log::error('Fusion generation failed', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);
            
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
        
        if (!$fusedData) {
            return redirect()->route('dashboard')
                ->with('info', 'No fusion data available yet. Generate your first fusion!');
        }
        
        // Load AI insights for this fusion data
        $aiInsight = \App\Models\AiInsight::where('fused_data_id', $fusedData->id)->first();
        
        return view('fusion.show', compact('fusedData', 'aiInsight'));
    }
}
