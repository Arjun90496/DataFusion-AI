<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
                
            $table->string('type'); // e.g., 'api_fetch', 'api_added', etc.
            $table->text('description');
            $table->string('icon'); // Tailwind/SVG icon name
            $table->string('color'); // blue, purple, green, red, etc.
            $table->string('link')->nullable(); // Optional link to related resource
            
            $table->timestamps();
            
            $table->index(['user_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
