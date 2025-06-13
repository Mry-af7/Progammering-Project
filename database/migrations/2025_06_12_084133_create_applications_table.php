<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Student
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            
            // Job/Position info
            $table->string('position_title');
            $table->text('position_description')->nullable();
            $table->enum('application_type', ['internship', 'part_time', 'full_time', 'graduate', 'project'])->default('internship');
            
            // Application details
            $table->text('cover_letter')->nullable();
            $table->string('cv_file_path')->nullable();
            $table->json('portfolio_links')->nullable(); // Array van URLs
            
            // Status tracking
            $table->enum('status', ['pending', 'under_review', 'interview_scheduled', 'interview_completed', 'offer_made', 'accepted', 'rejected', 'withdrawn'])->default('pending');
            $table->timestamp('submitted_at')->default(now());
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamp('interview_scheduled_at')->nullable();
            $table->timestamp('responded_at')->nullable();
            
            // Interview details
            $table->text('interview_notes')->nullable();
            $table->integer('interview_rating')->nullable(); // 1-10
            $table->text('feedback')->nullable();
            
            // Salary/compensation
            $table->decimal('offered_salary', 10, 2)->nullable();
            $table->text('benefits')->nullable();
            
            // Tracking
            $table->text('notes')->nullable(); // Student notes
            $table->boolean('is_favorite')->default(false);
            $table->json('tags')->nullable(); // Custom tags
            
            $table->timestamps();
            
            $table->index(['user_id', 'status']);
            $table->index(['company_id', 'status']);
            $table->index(['submitted_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};