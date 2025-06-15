<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('study_field_id')->constrained()->onDelete('cascade');
            
            // Profile information
            $table->text('bio')->nullable();
            $table->string('cv_url')->nullable();
            $table->string('profile_image')->nullable();
            
            // Study details
            $table->integer('study_year')->default(1); // 1, 2, 3, etc.
            $table->integer('graduation_year')->nullable();
            $table->string('current_education_level')->nullable();
            $table->enum('study_status', ['active', 'graduated', 'dropped_out', 'exchange'])->default('active');
            
            // Skills & Experience
            $table->json('technical_skills')->nullable(); // ["PHP", "JavaScript", "React"]
            $table->json('soft_skills')->nullable(); // ["Communication", "Teamwork"]
            $table->json('languages')->nullable(); // [{"language": "Dutch", "level": "native"}]
            $table->text('project_description')->nullable();
            $table->string('portfolio_url')->nullable();
            $table->string('github_url')->nullable();
            $table->string('linkedin_url')->nullable();
            
            // Career preferences
            $table->json('preferred_job_types')->nullable(); // ["internship", "part_time", "full_time"]
            $table->json('preferred_work_location')->nullable(); // ["Brussels", "Antwerp", "Remote"]
            $table->json('preferred_company_size')->nullable(); // ["startup", "large"]
            $table->json('preferred_industries')->nullable();
            $table->string('availability_status')->nullable();
            
            // Availability
            $table->date('available_from')->nullable();
            $table->enum('availability_type', ['immediately', 'specific_date', 'after_graduation'])->default('after_graduation');
            $table->json('available_days')->nullable(); // ["monday", "tuesday", "wednesday"]
            
            // Profile completion tracking
            $table->integer('profile_completion_percentage')->default(0);
            $table->timestamp('last_updated_at')->nullable();
            
            $table->timestamps();
            
            $table->index(['study_field_id', 'study_year']);
            $table->index(['graduation_year']);
            $table->index(['available_from']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_profiles');
    }
};