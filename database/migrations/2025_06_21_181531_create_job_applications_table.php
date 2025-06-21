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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Application status
            $table->enum('status', [
                'pending', 'reviewing', 'shortlisted', 
                'interview_scheduled', 'interview_completed', 
                'offer_made', 'offer_accepted', 'offer_rejected', 
                'rejected', 'withdrawn'
            ])->default('pending');
            $table->string('application_stage')->default('applied');
            
            // Application content
            $table->longText('cover_letter')->nullable();
            $table->string('resume_path')->nullable();
            $table->string('portfolio_url')->nullable();
            $table->json('additional_documents')->nullable();
            
            // Student preferences
            $table->integer('expected_salary')->nullable();
            $table->date('available_start_date')->nullable();
            $table->longText('motivation')->nullable();
            $table->longText('why_company')->nullable();
            $table->longText('relevant_experience')->nullable();
            $table->longText('additional_info')->nullable();
            
            // Application source
            $table->string('source')->nullable(); // Website, LinkedIn, referral, etc.
            $table->string('referral_name')->nullable();
            
            // Consent and privacy
            $table->boolean('consent_data_processing')->default(true);
            $table->boolean('consent_marketing')->default(false);
            
            // Admin and company notes
            $table->longText('admin_notes')->nullable();
            $table->longText('company_notes')->nullable();
            
            // Rating system
            $table->integer('hr_rating')->nullable(); // 1-5
            $table->integer('technical_rating')->nullable(); // 1-5
            $table->integer('cultural_fit_rating')->nullable(); // 1-5
            $table->decimal('overall_rating', 3, 2)->nullable();
            
            // Rejection and feedback
            $table->longText('rejection_reason')->nullable();
            $table->longText('feedback_given')->nullable();
            
            // Interview tracking
            $table->timestamp('interview_scheduled_at')->nullable();
            $table->timestamp('interview_completed_at')->nullable();
            
            // Offer tracking
            $table->timestamp('offer_made_at')->nullable();
            $table->timestamp('offer_accepted_at')->nullable();
            $table->timestamp('offer_rejected_at')->nullable();
            $table->date('start_date_confirmed')->nullable();
            
            // Communication tracking
            $table->timestamp('responded_at')->nullable();
            $table->timestamp('last_contact_at')->nullable();
            $table->date('follow_up_date')->nullable();
            
            // Archive system
            $table->timestamp('archived_at')->nullable();
            $table->unsignedBigInteger('archived_by')->nullable();
            
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('archived_by')->references('id')->on('users')->onDelete('set null');
            
            // Indexes for performance
            $table->index(['status', 'application_stage']);
            $table->index(['job_id', 'status']);
            $table->index(['student_id', 'status']);
            $table->index('created_at');
            
            // Unique constraint to prevent duplicate applications
            $table->unique(['job_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};