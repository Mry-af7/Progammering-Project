<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // HR representative
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->string('company_name')->nullable();
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->string('industry')->nullable();
            $table->string('company_size')->nullable();
            $table->integer('founded_year')->nullable();
            $table->string('headquarters')->nullable();
            $table->string('logo')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('company_type')->nullable();
            $table->json('specializations')->nullable();
            
            // HR Representative details
            $table->string('position_title'); // "HR Manager", "Talent Acquisition"
            $table->string('department')->nullable();
            
            // Company profile details
            $table->text('company_culture')->nullable();
            $table->text('what_we_offer')->nullable();
            $table->text('what_we_look_for')->nullable();
            
            // Student opportunities
            $table->json('offered_positions')->nullable(); // ["Internship", "Part-time", "Graduate program"]
            $table->json('required_skills')->nullable(); // ["PHP", "JavaScript"]
            $table->json('preferred_study_fields')->nullable(); // Study field IDs
            $table->boolean('offers_internships')->default(true);
            $table->boolean('offers_graduate_programs')->default(false);
            $table->boolean('offers_part_time')->default(false);
            
            // Compensation
            $table->decimal('internship_salary_min', 8, 2)->nullable();
            $table->decimal('internship_salary_max', 8, 2)->nullable();
            $table->decimal('graduate_salary_min', 8, 2)->nullable();
            $table->decimal('graduate_salary_max', 8, 2)->nullable();
            $table->json('benefits')->nullable(); // ["Health insurance", "Flexible hours"]
            
            // Application process
            $table->text('application_process')->nullable();
            $table->string('application_email')->nullable();
            $table->integer('typical_response_time_days')->nullable();
            
            // Social links
            $table->string('linkedin_company_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('facebook_url')->nullable();
            
            $table->timestamps();
            
            $table->index(['company_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_profiles');
    }
};