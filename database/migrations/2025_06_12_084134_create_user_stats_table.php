<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Profile stats
            $table->integer('profile_completion_percentage')->default(0);
            $table->integer('profile_views_count')->default(0);
            $table->integer('profile_views_this_month')->default(0);
            
            // Application stats
            $table->integer('applications_sent')->default(0);
            $table->integer('applications_pending')->default(0);
            $table->integer('applications_interview')->default(0);
            $table->integer('applications_offers')->default(0);
            $table->integer('applications_rejected')->default(0);
            
            // Engagement stats
            $table->integer('favorites_count')->default(0);
            $table->integer('messages_sent')->default(0);
            $table->integer('messages_received')->default(0);
            $table->integer('events_attended')->default(0);
            
            // Skill stats
            $table->integer('skills_count')->default(0);
            $table->integer('certifications_count')->default(0);
            $table->integer('projects_count')->default(0);
            
            // Social stats
            $table->integer('connections_count')->default(0);
            $table->integer('recommendations_count')->default(0);
            
            // Target/Goals
            $table->decimal('target_salary', 10, 2)->nullable();
            $table->date('graduation_target_date')->nullable();
            $table->json('career_goals')->nullable(); // Array van goals
            
            // Dates
            $table->timestamp('last_activity_at')->nullable();
            $table->timestamp('last_profile_update_at')->nullable();
            $table->date('stats_calculated_at')->default(now());
            
            $table->timestamps();
            
            $table->index(['user_id']);
            $table->index(['profile_completion_percentage']);
            $table->index(['last_activity_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_stats');
    }
};