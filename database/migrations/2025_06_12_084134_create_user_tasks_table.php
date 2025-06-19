<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Task details
            $table->string('title'); // "Complete Portfolio"
            $table->text('description'); // "Add 2 more projects"
            $table->enum('category', ['profile', 'application', 'skill', 'networking', 'general'])->default('general');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            
            // Status
            $table->boolean('is_completed')->default(false);
            $table->timestamp('completed_at')->nullable();
            $table->date('due_date')->nullable();
            
            // Progress
            $table->integer('progress_percentage')->default(0); // 0-100
            $table->text('notes')->nullable();
            
            // Related models
            $table->morphs('taskable'); // Can relate to StudentProfile, Application, etc.
            
            // Metadata
            $table->integer('sort_order')->default(0);
            $table->json('metadata')->nullable();
            
            $table->timestamps();
            
            $table->index(['user_id', 'is_completed']);
            $table->index(['category', 'priority']);
            $table->index(['due_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_tasks');
    }
};