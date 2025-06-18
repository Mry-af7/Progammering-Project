<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Activity details
            $table->string('activity_type'); // 'application_submitted', 'profile_viewed', 'skill_added', etc.
            $table->string('title'); // "Application submitted"
            $table->text('description'); // "Software Developer at Capgemini"
            $table->string('icon')->nullable(); // "✓", "👁", "🏆", etc.
            $table->string('color')->nullable(); // "bg-green-500", "bg-blue-500", etc.
            
            // Related models (polymorphic)
            $table->morphs('activityable'); // Can be Application, Company, Event, etc.
            
            // Metadata
            $table->json('metadata')->nullable(); // Extra data
            $table->string('url')->nullable(); // Link to related action
            
            // Status
            $table->boolean('is_read')->default(false);
            $table->boolean('is_important')->default(false);
            
            $table->timestamps();
            
            $table->index(['user_id', 'created_at']);
            $table->index(['activity_type']);
            $table->index(['is_read']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_activities');
    }
}; 