<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Create ai_insights table
 * 
 * Stores AI-generated insights from fused data snapshots.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ai_insights', function (Blueprint $table) {
            $table->id();
            
            // Relationships
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            
            $table->foreignId('fused_data_id')
                ->constrained('fused_data')
                ->onDelete('cascade');
            
            // Insight content
            $table->text('summary');
            $table->json('trends')->nullable();
            $table->json('recommendations')->nullable();
            $table->string('sentiment', 20)->nullable(); // positive, neutral, negative
            
            // Metadata
            $table->integer('tokens_used')->default(0);
            $table->string('model_used', 50)->default('gpt-3.5-turbo');
            
            $table->timestamps();
            
            // Indexes
            $table->index('user_id');
            $table->index('fused_data_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_insights');
    }
};
