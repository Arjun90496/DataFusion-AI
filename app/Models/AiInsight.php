<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * AiInsight Model
 * 
 * Represents AI-generated insights from fused data.
 */
class AiInsight extends Model
{
    protected $fillable = [
        'user_id',
        'fused_data_id',
        'summary',
        'trends',
        'recommendations',
        'sentiment',
        'tokens_used',
        'model_used',
    ];
    
    protected $casts = [
        'trends' => 'array',
        'recommendations' => 'array',
    ];
    
    /**
     * Relationship: Insight belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Relationship: Insight belongs to fused data
     */
    public function fusedData()
    {
        return $this->belongsTo(FusedData::class);
    }
    
    /**
     * Scope: Get latest insight for a user
     */
    public function scopeLatestForUser($query, $userId)
    {
        return $query->where('user_id', $userId)
            ->latest()
            ->first();
    }
    
    /**
     * Get sentiment badge color
     */
    public function getSentimentColorAttribute()
    {
        return match($this->sentiment) {
            'positive' => 'emerald',
            'negative' => 'red',
            default => 'slate',
        };
    }
}
