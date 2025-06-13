<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Notification content
            $table->string('title');
            $table->text('message');
            $table->enum('type', ['info', 'success', 'warning', 'error', 'reminder'])->default('info');
            $table->string('icon')->nullable(); // "📧", "✅", "⚠️", etc.
            
            // Action
            $table->string('action_url')->nullable();
            $table->string('action_text')->nullable(); // "View Application", "Complete Profile"
            
            // Related models
            $table->morphs('notifiable'); // Can relate to Application, Event, Message, etc.
            
            // Status
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->boolean('is_actionable')->default(false);
            $table->timestamp('expires_at')->nullable();
            
            // Metadata
            $table->json('data')->nullable(); // Extra notification data
            $table->integer('priority')->default(1); // 1=low, 5=high
            
            $table->timestamps();
            
            $table->index(['user_id', 'is_read']);
            $table->index(['type']);
            $table->index(['created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};