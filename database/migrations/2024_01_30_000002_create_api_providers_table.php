<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for API Providers table
 * 
 * Stores information about supported API providers (OpenWeatherMap, NewsAPI, etc.)
 * This is a reference table that defines which APIs the system supports.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Creates the api_providers table with provider details and configuration.
     */
    public function up(): void
    {
        Schema::create('api_providers', function (Blueprint $table) {
            $table->id();
            
            // Provider identification
            $table->string('name');              // Display name: "OpenWeatherMap"
            $table->string('slug')->unique();    // URL-safe identifier: "openweathermap"
            
            // API configuration
            $table->string('base_url');          // Base URL for API: "https://api.openweathermap.org"
            $table->json('required_fields')->nullable(); // Fields needed: ["api_key"] or ["api_key", "client_secret"]
            
            // UI display
            $table->string('icon')->nullable();  // Icon identifier: "cloud", "newspaper"
            $table->string('color')->nullable(); // Theme color: "blue", "red", "purple"
            $table->text('description')->nullable();  // Description of the API service
            
            // Status
            $table->boolean('is_active')->default(true);  // Whether this provider is available
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_providers');
    }
};
