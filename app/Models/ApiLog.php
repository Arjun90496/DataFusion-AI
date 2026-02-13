<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * ApiLog Model
 * 
 * Represents a logged API request/response.
 */
class ApiLog extends Model
{
    protected $fillable = [
        'user_id',
        'method',
        'endpoint',
        'url',
        'ip_address',
        'user_agent',
        'status_code',
        'response_time_ms',
        'error_message',
        'stack_trace',
    ];
    
    /**
     * Relationship: Log belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Scope: Get error logs
     */
    public function scopeErrors($query)
    {
        return $query->where('status_code', '>=', 400);
    }
    
    /**
     * Scope: Get recent logs
     */
    public function scopeRecent($query, $limit = 50)
    {
        return $query->latest()->limit($limit);
    }
    
    /**
     * Scope: Get logs for today
     */
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }
    
    /**
     * Check if this was a successful request
     */
    public function isSuccessful(): bool
    {
        return $this->status_code >= 200 && $this->status_code < 300;
    }
    
    /**
     * Check if this was an error
     */
    public function isError(): bool
    {
        return $this->status_code >= 400;
    }
}
