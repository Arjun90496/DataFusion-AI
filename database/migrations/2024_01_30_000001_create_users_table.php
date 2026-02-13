<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Create Users Table
 * 
 * This migration creates the 'users' table that stores all user account information.
 * 
 * BEGINNER EXPLANATION:
 * - Migrations are like "version control" for your database
 * - They allow you to create/modify tables using PHP code instead of SQL
 * - Laravel tracks which migrations have been run to prevent duplicates
 * 
 * HOW TO RUN:
 * php artisan migrate
 * 
 * HOW TO ROLLBACK (undo):
 * php artisan migrate:rollback
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     * Creates the users table with all necessary columns.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            // Primary key - auto-incrementing ID for each user
            $table->id();
            
            // User's full name
            // string() = VARCHAR(255) in MySQL
            $table->string('name');
            
            // User's email address - used for login
            // unique() = prevents duplicate emails (each email can only be used once)
            $table->string('email')->unique();
            
            // User's hashed password
            // IMPORTANT: Never store passwords in plain text!
            // Laravel automatically hashes passwords using bcrypt
            $table->string('password');
            
            // Remember token - used for "Remember Me" functionality
            // When users check "Remember Me", Laravel creates a token
            // This allows them to stay logged in even after closing browser
            // nullable() = this field can be empty (NULL)
            $table->rememberToken();
            
            // Timestamps - automatically creates two columns:
            // 1. created_at: when the user registered
            // 2. updated_at: when the user's info was last modified
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Drops (deletes) the users table.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
