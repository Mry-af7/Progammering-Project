<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Temporarily commented out to allow seeding
        /*
        // Add indexes to users table
        Schema::table('users', function (Blueprint $table) {
            $table->index('email');
            $table->index('role');
        });

        // Add indexes to jobs table
        Schema::table('jobs', function (Blueprint $table) {
            $table->index('company_id');
            $table->index('status');
            $table->index('type');
            $table->index('location');
        });

        // Add indexes to events table
        Schema::table('events', function (Blueprint $table) {
            $table->index('company_id');
            $table->index('start_date');
            $table->index('end_date');
        });

        // Add indexes to messages table
        Schema::table('messages', function (Blueprint $table) {
            $table->index('sender_id');
            $table->index('receiver_id');
            $table->index('created_at');
        });

        // Add indexes to notifications table
        Schema::table('notifications', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('type');
            $table->index('read_at');
        });
        */
    }

    public function down(): void
    {
        // Temporarily commented out
        /*
        // Remove indexes from users table
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['email']);
            $table->dropIndex(['role']);
        });

        // Remove indexes from jobs table
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropIndex(['company_id']);
            $table->dropIndex(['status']);
            $table->dropIndex(['type']);
            $table->dropIndex(['location']);
        });

        // Remove indexes from events table
        Schema::table('events', function (Blueprint $table) {
            $table->dropIndex(['company_id']);
            $table->dropIndex(['start_date']);
            $table->dropIndex(['end_date']);
        });

        // Remove indexes from messages table
        Schema::table('messages', function (Blueprint $table) {
            $table->dropIndex(['sender_id']);
            $table->dropIndex(['receiver_id']);
            $table->dropIndex(['created_at']);
        });

        // Remove indexes from notifications table
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['type']);
            $table->dropIndex(['read_at']);
        });
        */
    }
}; 