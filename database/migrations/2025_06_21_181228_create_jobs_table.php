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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            
            // Basic job info
            $table->string('title');
            $table->longText('description');
            $table->longText('requirements')->nullable();
            $table->longText('responsibilities')->nullable();
            $table->string('location')->nullable();
            $table->enum('type', ['full-time', 'part-time', 'contract', 'freelance', 'internship', 'temporary'])->default('full-time');
            $table->string('category')->nullable();
            $table->enum('status', ['pending', 'active', 'inactive', 'rejected', 'expired'])->default('pending');
            
            // Salary info
            $table->integer('salary_min')->nullable();
            $table->integer('salary_max')->nullable();
            $table->string('salary_currency', 3)->default('EUR');
            
            // Experience and education
            $table->enum('experience_level', ['entry', 'junior', 'mid', 'senior', 'lead', 'executive'])->nullable();
            $table->string('education_level')->nullable();
            $table->string('employment_type')->nullable();
            $table->boolean('remote_allowed')->default(false);
            
            // Dates and deadlines
            $table->timestamp('expires_at')->nullable();
            $table->date('start_date')->nullable();
            $table->date('application_deadline')->nullable();
            
            // Features and tracking
            $table->boolean('featured')->default(false);
            $table->timestamp('featured_until')->nullable();
            $table->boolean('urgent')->default(false);
            $table->integer('views')->default(0);
            $table->integer('application_count')->default(0);
            $table->integer('click_count')->default(0);
            
            // Additional info
            $table->string('external_url')->nullable();
            $table->longText('how_to_apply')->nullable();
            $table->json('benefits')->nullable();
            $table->longText('company_culture')->nullable();
            $table->longText('growth_opportunities')->nullable();
            $table->json('technologies_used')->nullable();
            $table->json('skills_required')->nullable();
            $table->json('nice_to_have_skills')->nullable();
            
            // Internship specific
            $table->boolean('is_internship')->default(false);
            $table->string('internship_duration')->nullable();
            $table->integer('internship_stipend')->nullable();
            
            // Contact info
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            
            // Admin approval system
            $table->text('admin_notes')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->unsignedBigInteger('rejected_by')->nullable();
            
            // SEO
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('rejected_by')->references('id')->on('users')->onDelete('set null');
            
            // Indexes for performance
            $table->index(['status', 'featured', 'expires_at']);
            $table->index(['type', 'experience_level']);
            $table->index(['company_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};