<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conversation_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Participant role
            $table->enum('role', ['member', 'admin', 'moderator'])->default('member');
            
            // Status
            $table->timestamp('joined_at')->default(now());
            $table->timestamp('left_at')->nullable();
            $table->boolean('is_active')->default(true);
            
            // Notifications
            $table->boolean('notifications_enabled')->default(true);
            $table->timestamp('last_read_at')->nullable();
            
            $table->timestamps();
            
            $table->unique(['conversation_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conversation_participants');
    }
};