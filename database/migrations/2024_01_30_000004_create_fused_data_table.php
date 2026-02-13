<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Create fused_data table
 * 
 * Stores aggregated data from multiple API sources in a flexible JSON format.
 * Each record represents a "fusion snapshot" for a user at a specific point in time.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fused_data', function (Blueprint $table) {
            $table->id();
            
            // User relationship
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            
            // The core fused dataset (flexible JSON structure)
            // Contains: weather, news, crypto, and fusion_metadata
            $table->json('payload');
            
            // Metadata for quick filtering and analysis
            $table->integer('sources_count')->default(0);
            $table->string('primary_location')->nullable(); // e.g., "London"
            $table->timestamp('fused_at');
            
            $table->timestamps();
            
            // Indexes for performance
            $table->index('user_id');
            $table->index('fused_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fused_data');
    }
};
