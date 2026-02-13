<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Create api_logs table
 * 
 * Tracks all API requests, responses, errors, and performance metrics.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('api_logs', function (Blueprint $table) {
            $table->id();
            
            // User tracking
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            
            // Request details
            $table->string('method', 10); // GET, POST, PUT, DELETE, etc.
            $table->string('endpoint', 255);
            $table->text('url');
            $table->ipAddress('ip_address');
            $table->text('user_agent')->nullable();
            
            // Response details
            $table->integer('status_code');
            $table->integer('response_time_ms')->default(0); // milliseconds
            
            // Error tracking
            $table->text('error_message')->nullable();
            $table->text('stack_trace')->nullable();
            
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['user_id', 'created_at']);
            $table->index('status_code');
            $table->index('endpoint');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_logs');
    }
};
