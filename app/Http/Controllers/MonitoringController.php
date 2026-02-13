<?php

namespace App\Http\Controllers;

use App\Models\ApiLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * MonitoringController
 * 
 * Displays activity logs, metrics, and monitoring dashboard
 */
class MonitoringController extends Controller
{
    /**
     * Show monitoring dashboard
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get today's stats
        $todayLogs = ApiLog::where('user_id', $user->id)->today()->get();
        
        $stats = [
            'total_requests' => $todayLogs->count(),
            'successful_requests' => $todayLogs->where('status_code', '<', 400)->count(),
            'failed_requests' => $todayLogs->where('status_code', '>=', 400)->count(),
            'avg_response_time' => round($todayLogs->avg('response_time_ms')),
        ];
        
        // Get recent logs
        $recentLogs = ApiLog::where('user_id', $user->id)
            ->recent(20)
            ->get();
        
        // Get error logs
        $errorLogs = ApiLog::where('user_id', $user->id)
            ->errors()
            ->recent(10)
            ->get();
        
        // Get endpoint statistics
        $endpointStats = ApiLog::where('user_id', $user->id)
            ->today()
            ->select('endpoint', DB::raw('count(*) as count'), DB::raw('avg(response_time_ms) as avg_time'))
            ->groupBy('endpoint')
            ->orderByDesc('count')
            ->limit(10)
            ->get();
        
        return view('monitoring.index', compact('stats', 'recentLogs', 'errorLogs', 'endpointStats'));
    }
}
