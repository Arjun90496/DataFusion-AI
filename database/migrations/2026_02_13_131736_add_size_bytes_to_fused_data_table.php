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
        Schema::table('fused_data', function (Blueprint $table) {
            $table->unsignedBigInteger('size_bytes')->default(0)->after('primary_location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fused_data', function (Blueprint $table) {
            $table->dropColumn('size_bytes');
        });
    }
};
