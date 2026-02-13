<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * ApiProvider Model
 * 
 * Represents an external API service that users can connect to.
 * Examples: OpenWeatherMap, NewsAPI, OpenAI, GitHub API
 * 
 * This is a reference/configuration table - providers are seeded by admins.
 */
class ApiProvider extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'slug',
        'base_url',
        'icon',
        'color',
        'description',
        'required_fields',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     * 
     * @var array<string, string>
     */
    protected $casts = [
        'required_fields' => 'array',  // JSON to PHP array
        'is_active' => 'boolean',
    ];

    /**
     * Relationship: A provider can have many API keys from different users
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function apiKeys()
    {
        return $this->hasMany(ApiKey::class);
    }

    /**
     * Scope: Get only active providers
     * 
     * Usage: ApiProvider::active()->get()
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get provider by slug
     * 
     * Usage: ApiProvider::findBySlug('openweathermap')
     */
    public static function findBySlug($slug)
    {
        return static::where('slug', $slug)->first();
    }
}
