<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * User Model
 * 
 * BEGINNER EXPLANATION:
 * - Models represent database tables in Laravel (ORM - Object Relational Mapping)
 * - This User model represents the 'users' table
 * - Instead of writing SQL queries, you interact with the model using PHP
 * - Example: User::create(['name' => 'John']) creates a new user
 * 
 * WHAT DOES "Authenticatable" MEAN?
 * - It's a special Laravel class that provides authentication functionality
 * - It handles password hashing, verification, and "remember me" tokens
 * - Without this, you'd have to write all authentication logic manually
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     * 
     * BEGINNER EXPLANATION:
     * - Mass assignment = filling multiple fields at once
     * - Example: User::create(['name' => 'John', 'email' => 'john@example.com'])
     * - Only fields listed in $fillable can be mass-assigned
     * - This prevents attackers from setting fields like 'is_admin' without permission
     * 
     * WHY NOT PASSWORD?
     * - Password is handled separately to ensure it's always hashed
     * - We'll hash it manually in the controller before saving
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     * 
     * BEGINNER EXPLANATION:
     * - When you convert a User to JSON (e.g., for an API response),
     *   these fields will be automatically excluded
     * - This prevents accidentally exposing sensitive data
     * - Example: If you return User data to frontend, password won't be included
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     * 
     * BEGINNER EXPLANATION:
     * - Casting automatically converts database values to specific PHP types
     * - Example: 'email_verified_at' stored as string in DB,
     *   but Laravel converts it to a DateTime object in PHP
     * - This makes working with dates much easier
     * 
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // Automatically hash password when setting
        ];
    }

    /**
     * Relationship: A user has many API keys
     */
    public function apiKeys()
    {
        return $this->hasMany(ApiKey::class);
    }

    /**
     * Relationship: A user has many fused datasets
     */
    public function fusedData()
    {
        return $this->hasMany(FusedData::class);
    }

    /**
     * Relationship: A user has many AI insights
     */
    public function aiInsights()
    {
        return $this->hasMany(AiInsight::class);
    }

    /**
     * Relationship: A user has many activities
     */
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    /**
     * Helper: Log a new activity for the user
     * 
     * @param string $type
     * @param string $description
     * @param string $icon
     * @param string $color
     * @param string|null $link
     * @return Activity
     */
    public function logActivity($type, $description, $icon = 'info-circle', $color = 'indigo', $link = null)
    {
        return $this->activities()->create([
            'type' => $type,
            'description' => $description,
            'icon' => $icon,
            'color' => $color,
            'link' => $link,
        ]);
    }
}
