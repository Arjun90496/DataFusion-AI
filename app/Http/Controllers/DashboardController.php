<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ApiKey;
use App\Models\Activity;
use App\Models\AiInsight;
use App\Models\FusedData;

/**
 * DashboardController
 * 
 * Handles the main user dashboard display, showing:
 * - User statistics (API count, fetches, insights, storage)
 * - Connected API cards with status indicators
 * - Recent activity feed
 * - AI-generated insights
 * - Data visualization placeholders
 */
class DashboardController extends Controller
{
    /**
     * Display the main dashboard.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get user's connected APIs with their provider info
        $connectedApis = $user->apiKeys()
            ->with('provider')
            ->get()
            ->map(function ($key) {
                // Map database fields to the structure expected by the frontend
                return [
                    'id' => $key->id,
                    'name' => $key->name,
                    'provider' => $key->provider->name,
                    'icon' => $key->provider->icon,
                    'status' => $key->status === 'active' ? 'online' : ($key->status === 'error' ? 'offline' : 'pending'),
                    'last_sync' => $key->last_used_at ? $key->last_used_at->diffForHumans() : 'Never',
                    'color' => $key->provider->color,
                    'fetch_count' => \App\Models\ApiLog::where('user_id', Auth::id())->where('endpoint', 'LIKE', '%' . $key->provider->slug . '%')->count(),
                    'error_rate' => 0.0, // Future: Calculate based on logs
                    'description' => $key->provider->description,
                ];
            });
            
        // Get user's recent activities
        $recentActivity = $user->activities()
            ->latest()
            ->limit(10)
            ->get()
            ->map(function ($activity) {
                return [
                    'id' => $activity->id,
                    'type' => $activity->type,
                    'description' => $activity->description,
                    'timestamp' => $activity->created_at->diffForHumans(),
                    'icon' => $activity->icon,
                    'color' => $activity->color,
                ];
            });
            
        // Get user's AI insights
        $aiInsights = $user->aiInsights()
            ->latest()
            ->limit(5)
            ->get()
            ->map(function ($insight) {
                return [
                    'id' => $insight->id,
                    'title' => $insight->sentiment === 'positive' ? 'Positive Trend' : ($insight->sentiment === 'negative' ? 'Alert' : 'Insight'),
                    'description' => $insight->summary,
                    'severity' => $insight->sentiment === 'positive' ? 'success' : ($insight->sentiment === 'negative' ? 'warning' : 'info'),
                    'icon' => $insight->sentiment === 'positive' ? 'check-circle' : ($insight->sentiment === 'negative' ? 'exclamation-triangle' : 'lightbulb'),
                    'action' => 'View Details',
                    'created_at' => $insight->created_at->diffForHumans(),
                ];
            });
            
        // Calculate statistics
        $stats = [
            'api_count' => $user->apiKeys()->count(),
            'total_fetches' => \App\Models\ApiLog::where('user_id', Auth::id())->count(),
            'insights_count' => $user->aiInsights()->count(),
            'storage_used' => $this->calculateStorageUsed($user),
        ];

        // Get latest fusion data for summary
        $latestFusion = $user->fusedData()->latest('fused_at')->first();
        
        return view('dashboard', compact('user', 'connectedApis', 'recentActivity', 'aiInsights', 'stats', 'latestFusion'));
    }
    
    
    /**
     * Calculate total storage used by all APIs.
     * 
     * @param User $user
     * @return float Storage in MB
     */
    private function calculateStorageUsed($user)
    {
        // Calculate actual data size from fused_data table
        $sizeBytes = $user->fusedData()->sum('size_bytes') ?? 0;
        return round($sizeBytes / (1024 * 1024), 2); // Convert Bytes to MB
    }
}
