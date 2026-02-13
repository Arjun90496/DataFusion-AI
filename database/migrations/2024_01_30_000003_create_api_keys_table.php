<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for API Keys table
 * 
 * Stores encrypted user API keys for external services.
 * Each user can have multiple API keys for different providers.
 * 
 * SECURITY:
 * - API keys are ENCRYPTED using Laravel's Crypt facade
 * - Keys are NEVER exposed to frontend (only masked versions)
 * - User isolation via foreign key constraint
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Creates the api_keys table with encryption and user isolation.
     */
    public function up(): void
    {
        Schema::create('api_keys', function (Blueprint $table) {
            $table->id();
            
            // Relationships
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');  // Delete user's keys when user is deleted
            
            $table->foreignId('api_provider_id')
                ->constrained()
                ->onDelete('cascade');  // Delete keys when provider is removed
            
            // API Key data
            $table->string('name');              // User's nickname for this key: "My Weather API"
            $table->text('encrypted_key');       // ENCRYPTED API key value - stored as encrypted string
            
            // Status and control
            $table->boolean('is_enabled')->default(true);  // Soft disable without deletion
            $table->string('status')->default('pending');  // pending, active, error
            $table->text('status_message')->nullable();    // Error message if status=error
            
            // Usage tracking
            $table->timestamp('last_used_at')->nullable();   // Last time this key was used for API call
            $table->timestamp('last_tested_at')->nullable(); // Last time connection was tested
            
            $table->timestamps();
            
            // Indexes for common queries
            $table->index(['user_id', 'is_enabled']);  // Find enabled keys for user
            $table->index(['user_id', 'api_provider_id']);  // Find keys by provider
            
            // Prevent duplicate names per user and provider
            $table->unique(['user_id', 'api_provider_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_keys');
    }
};
