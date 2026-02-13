<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ApiLog;
use Illuminate\Support\Facades\Auth;

/**
 * ApiLoggingMiddleware
 * 
 * Logs all API requests, responses, errors, and performance metrics.
 */
class ApiLoggingMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $startTime = microtime(true);
        
        // Process the request
        $response = $next($request);
        
        // Calculate response time
        $endTime = microtime(true);
        $responseTime = ($endTime - $startTime) * 1000; // Convert to milliseconds
        
        // Log the request
        $this->logRequest($request, $response, $responseTime);
        
        return $response;
    }
    
    /**
     * Log the API request
     */
    protected function logRequest(Request $request, $response, float $responseTime): void
    {
        try {
            // Extract error information if present
            $errorMessage = null;
            $stackTrace = null;
            
            if ($response->status() >= 400) {
                $content = $response->getContent();
                if (is_string($content)) {
                    $decoded = json_decode($content, true);
                    $errorMessage = $decoded['message'] ?? 'Unknown error';
                }
            }
            
            ApiLog::create([
                'user_id' => Auth::id(),
                'method' => $request->method(),
                'endpoint' => $request->path(),
                'url' => $request->fullUrl(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'status_code' => $response->status(),
                'response_time_ms' => round($responseTime),
                'error_message' => $errorMessage,
                'stack_trace' => $stackTrace,
            ]);
        } catch (\Exception $e) {
            // Silently fail - don't break the app if logging fails
            \Log::error('Failed to log API request', [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
