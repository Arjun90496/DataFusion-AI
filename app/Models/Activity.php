<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'type',
        'description',
        'icon',
        'color',
        'link',
    ];

    /**
     * Relationship: Activity belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
