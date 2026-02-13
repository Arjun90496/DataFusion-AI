<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * FusedData Model
 * 
 * Represents a snapshot of aggregated data from multiple API sources.
 * The payload is stored as JSON for maximum flexibility.
 */
class FusedData extends Model
{
    protected $table = 'fused_data';
    
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'payload',
        'sources_count',
        'primary_location',
        'fused_at',
    ];
    
    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'payload' => 'array',
        'fused_at' => 'datetime',
    ];
    
    /**
     * Relationship: Fused data belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Scope: Get latest fusion for a user
     */
    public function scopeLatestForUser($query, $userId)
    {
        return $query->where('user_id', $userId)
            ->latest('fused_at')
            ->first();
    }
    
    /**
     * Get weather data from payload
     */
    public function getWeatherAttribute()
    {
        return $this->payload['environment'] ?? null;
    }
    
    /**
     * Get news data from payload
     */
    public function getNewsAttribute()
    {
        return $this->payload['briefing'] ?? null;
    }
    
    /**
     * Get crypto data from payload
     */
    public function getCryptoAttribute()
    {
        return $this->payload['markets'] ?? null;
    }
    
    /**
     * Get fusion metadata
     */
    public function getMetadataAttribute()
    {
        return $this->payload['fusion_metadata'] ?? null;
    }
}
