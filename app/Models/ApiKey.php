<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

/**
 * ApiKey Model
 * 
 * Stores encrypted API keys for external services.
 * Each user can have multiple API keys for different providers.
 * 
 * SECURITY FEATURES:
 * - Automatic encryption/decryption using Laravel Crypt
 * - Masked display for frontend ($apiKey->masked_key)
 * - Raw key hidden from JSON serialization
 * - User-specific isolation via scopes
 * 
 * USAGE:
 * 
 * // Create (automatic encryption)
 * $apiKey = ApiKey::create([
 *     'user_id' => 1,
 *     'api_provider_id' => 1,
 *     'name' => 'My Weather API',
 *     'api_key' => 'sk-abc123xyz', // Stored encrypted
 * ]);
 * 
 * // Read (automatic decryption)
 * $rawKey = $apiKey->api_key; // Decrypted value
 * $masked = $apiKey->masked_key; // "sk-****...****xyz"
 */
class ApiKey extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'api_provider_id',
        'name',
        'encrypted_key',  // Note: Use 'api_key' accessor, not this directly
        'is_enabled',
        'status',
        'status_message',
        'last_used_at',
        'last_tested_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     * 
     * CRITICAL: Prevents encrypted_key from being exposed in JSON responses
     */
    protected $hidden = [
        'encrypted_key',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'is_enabled' => 'boolean',
        'last_used_at' => 'datetime',
        'last_tested_at' => 'datetime',
    ];

    /**
     * ENCRYPTION: Set the API key (encrypts before storing)
     * 
     * When you do: $apiKey->api_key = 'sk-abc123'
     * Laravel calls this, which encrypts and stores in 'encrypted_key'
     * 
     * @param string $value The plain API key
     */
    public function setApiKeyAttribute($value)
    {
        $this->attributes['encrypted_key'] = Crypt::encryptString($value);
    }

    /**
     * DECRYPTION: Get the API key (decrypts when accessing)
     * 
     * When you do: $apiKey->api_key
     * Laravel calls this, which decrypts from 'encrypted_key'
     * 
     * @return string The decrypted API key
     */
    public function getApiKeyAttribute()
    {
        try {
            return Crypt::decryptString($this->attributes['encrypted_key']);
        } catch (DecryptException $e) {
            // If decryption fails (corrupted data, wrong APP_KEY, etc.)
            return null;
        }
    }

    /**
     * Get masked version of API key for frontend display
     * 
     * Examples:
     * - "sk-proj-abc123xyz789" → "sk-p****...****z789"
     * - "ghp_1234567890abcdef" → "ghp_****...****cdef"
     * - "short" → "sh**t"
     * 
     * @return string Masked key
     */
    public function getMaskedKeyAttribute()
    {
        $key = $this->api_key;
        
        if (!$key) {
            return '****'; // If decryption failed
        }
        
        $length = strlen($key);
        
        // Very short keys: mask most of it
        if ($length <= 4) {
            return str_repeat('*', $length);
        }
        
        // Short keys: show first 2 and last 2
        if ($length <= 8) {
            return substr($key, 0, 2) . str_repeat('*', $length - 4) . substr($key, -2);
        }
        
        // Normal keys: show first 4 and last 4
        return substr($key, 0, 4) . str_repeat('*', min(12, $length - 8)) . substr($key, -4);
    }

    /**
     * Relationship: API key belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: API key belongs to a provider
     */
    public function provider()
    {
        return $this->belongsTo(ApiProvider::class, 'api_provider_id');
    }

    /**
     * Scope: Get only enabled API keys
     * 
     * Usage: ApiKey::enabled()->get()
     */
    public function scopeEnabled($query)
    {
        return $query->where('is_enabled', true);
    }

    /**
     * Scope: Get API keys for a specific user
     * 
     * Usage: ApiKey::forUser(Auth::id())->get()
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope: Get API keys by provider
     * 
     * Usage: ApiKey::byProvider($providerId)->get()
     */
    public function scopeByProvider($query, $providerId)
    {
        return $query->where('api_provider_id', $providerId);
    }

    /**
     * Scope: Get API keys by status
     * 
     * Usage: ApiKey::withStatus('active')->get()
     */
    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Mark this API key as used (updates last_used_at)
     */
    public function markAsUsed()
    {
        $this->update(['last_used_at' => now()]);
    }

    /**
     * Update connection status
     * 
     * @param string $status 'active', 'error', 'pending'
     * @param string|null $message Optional status message
     */
    public function updateStatus($status, $message = null)
    {
        $this->update([
            'status' => $status,
            'status_message' => $message,
            'last_tested_at' => now(),
        ]);
    }

    /**
     * Fetch data from the associated API provider
     * 
     * @param array $params Query parameters
     * @return \App\Services\ApiAdapters\Base\ApiResponse
     */
    public function fetch(array $params = [])
    {
        $adapter = \App\Services\ApiAdapters\ApiAdapterFactory::make($this);
        return $adapter->fetch($params);
    }
    
    /**
     * Test the connection to the API provider
     * 
     * @return bool
     */
    public function testConnection(): bool
    {
        try {
            $adapter = \App\Services\ApiAdapters\ApiAdapterFactory::make($this);
            return $adapter->validate();
        } catch (\Exception $e) {
            return false;
        }
    }
}
