<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * DashboardController
 * 
 * Handles the main user dashboard display, showing:
 * - User statistics (API count, fetches, insights, storage)
 * - Connected API cards with status indicators
 * - Recent activity feed
 * - AI-generated insights
 * - Data visualization placeholders
 * 
 * Note: In Phase 3, we use sample/placeholder data to demonstrate the UI.
 * Real data integration happens in Phase 4 (API Keys), Phase 6 (Data Fusion),
 * and Phase 7 (AI Insights).
 */
class DashboardController extends Controller
{
    /**
     * Display the main dashboard.
     * 
     * This method:
     * 1. Gets the authenticated user
     * 2. Fetches connected APIs (placeholder data for now)
     * 3. Gets recent activity (placeholder)
     * 4. Retrieves AI insights (placeholder)
     * 5. Calculates statistics
     * 6. Passes all data to the dashboard view
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get the currently authenticated user
        // The 'auth' middleware ensures only logged-in users can access this
        $user = Auth::user();
        
        // Get connected APIs (sample data - will be real database queries in Phase 4)
        $connectedApis = $this->getSampleApis();
        
        // Get recent activity timeline (sample data - will be real in Phase 5)
        $recentActivity = $this->getSampleActivity();
        
        // Get AI insights (sample data - will be real AI-generated in Phase 7)
        $aiInsights = $this->getSampleInsights();
        
        // Calculate statistics for the stat cards
        $stats = [
            'api_count' => count($connectedApis),
            'total_fetches' => array_sum(array_column($connectedApis, 'fetch_count')),
            'insights_count' => count($aiInsights),
            'storage_used' => $this->calculateStorageUsed($connectedApis),
        ];
        
        // Pass all data to the dashboard view
        return view('dashboard', compact('user', 'connectedApis', 'recentActivity', 'aiInsights', 'stats'));
    }
    
    /**
     * Get sample API data for demonstration.
     * 
     * In Phase 4, this will be replaced with:
     * return ApiKey::where('user_id', Auth::id())->with('status')->get();
     * 
     * Each API has:
     * - id: Unique identifier
     * - name: Display name of the API
     * - provider: API provider name
     * - icon: Icon identifier for display
     * - status: online (working), offline (error), pending (not tested)
     * - last_sync: Human-readable time since last data fetch
     * - color: Theme color for the card
     * - fetch_count: Number of successful data fetches
     * - error_rate: Percentage of failed requests (0.0 to 1.0)
     * 
     * @return array
     */
    private function getSampleApis()
    {
        return [
            [
                'id' => 1,
                'name' => 'OpenWeatherMap',
                'provider' => 'OpenWeatherMap API',
                'icon' => 'cloud',
                'status' => 'online',
                'last_sync' => '2 minutes ago',
                'color' => 'blue',
                'fetch_count' => 145,
                'error_rate' => 0.02,
                'description' => 'Global weather data and forecasts',
            ],
            [
                'id' => 2,
                'name' => 'News API',
                'provider' => 'NewsAPI.org',
                'icon' => 'newspaper',
                'status' => 'offline',
                'last_sync' => 'Never',
                'color' => 'red',
                'fetch_count' => 0,
                'error_rate' => 1.0,
                'description' => 'Breaking news headlines worldwide',
            ],
            [
                'id' => 3,
                'name' => 'OpenAI GPT',
                'provider' => 'OpenAI API',
                'icon' => 'sparkles',
                'status' => 'pending',
                'last_sync' => '1 hour ago',
                'color' => 'yellow',
                'fetch_count' => 23,
                'error_rate' => 0.0,
                'description' => 'AI-powered text generation and analysis',
            ],
            [
                'id' => 4,
                'name' => 'GitHub API',
                'provider' => 'GitHub REST API',
                'icon' => 'code',
                'status' => 'online',
                'last_sync' => '15 minutes ago',
                'color' => 'purple',
                'fetch_count' => 67,
                'error_rate' => 0.05,
                'description' => 'Repository and user data from GitHub',
            ],
        ];
    }
    
    /**
     * Get sample activity data for the timeline.
     * 
     * In Phase 5, this will query the database:
     * return Activity::where('user_id', Auth::id())->latest()->limit(10)->get();
     * 
     * @return array
     */
    private function getSampleActivity()
    {
        return [
            [
                'id' => 1,
                'type' => 'api_fetch',
                'description' => 'Fetched weather data from OpenWeatherMap',
                'timestamp' => '2 minutes ago',
                'icon' => 'download',
                'color' => 'blue',
            ],
            [
                'id' => 2,
                'type' => 'insight_generated',
                'description' => 'AI generated new insight about weather trends',
                'timestamp' => '15 minutes ago',
                'icon' => 'lightbulb',
                'color' => 'purple',
            ],
            [
                'id' => 3,
                'type' => 'api_added',
                'description' => 'Added GitHub API connection',
                'timestamp' => '1 hour ago',
                'icon' => 'plus-circle',
                'color' => 'green',
            ],
            [
                'id' => 4,
                'type' => 'api_error',
                'description' => 'News API connection failed - invalid key',
                'timestamp' => '2 hours ago',
                'icon' => 'exclamation-triangle',
                'color' => 'red',
            ],
        ];
    }
    
    /**
     * Get sample AI insights for demonstration.
     * 
     * In Phase 7, this will call the AI service:
     * return AIInsightService::generateInsights($user);
     * 
     * Each insight has:
     * - id: Unique identifier
     * - title: Short headline
     * - description: Detailed explanation
     * - severity: info, warning, success, or error
     * - icon: Icon identifier
     * - action: Suggested action button text
     * - created_at: When the insight was generated
     * 
     * @return array
     */
    private function getSampleInsights()
    {
        return [
            [
                'id' => 1,
                'title' => 'Weather Trends Detected',
                'description' => 'Temperature patterns show 15% increase over last month. Consider analyzing historical data for seasonal predictions.',
                'severity' => 'info',
                'icon' => 'chart-line',
                'action' => 'View Report',
                'created_at' => '10 minutes ago',
            ],
            [
                'id' => 2,
                'title' => 'API Rate Limit Warning',
                'description' => 'News API approaching rate limit (85% used). Consider upgrading to premium plan or reducing fetch frequency.',
                'severity' => 'warning',
                'icon' => 'exclamation-triangle',
                'action' => 'Upgrade Plan',
                'created_at' => '1 hour ago',
            ],
            [
                'id' => 3,
                'title' => 'Data Correlation Found',
                'description' => 'AI detected strong correlation between weather changes and news topics. 73% match rate in climate-related articles.',
                'severity' => 'success',
                'icon' => 'check-circle',
                'action' => 'Explore Data',
                'created_at' => '3 hours ago',
            ],
        ];
    }
    
    /**
     * Calculate total storage used by all APIs.
     * 
     * In Phase 6, this will calculate actual data size:
     * return DataStorage::where('user_id', Auth::id())->sum('size_bytes');
     * 
     * @param array $apis
     * @return int Storage in MB
     */
    private function calculateStorageUsed($apis)
    {
        // Sample calculation: each fetch uses ~10KB on average
        $totalFetches = array_sum(array_column($apis, 'fetch_count'));
        return round(($totalFetches * 10) / 1024, 2); // Convert KB to MB
    }
}
