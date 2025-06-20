<?php

// Migration: create_companies_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('email');
            $table->foreignId('industry_id')->nullable()->constrained();
            $table->foreignId('company_size_id')->nullable()->constrained();
            $table->string('website')->nullable();
            $table->integer('founded_year')->nullable();
            $table->string('headquarters')->nullable();
            $table->text('description')->nullable();
            $table->text('mission_statement')->nullable();
            $table->text('company_culture')->nullable();
            $table->enum('remote_policy', ['fully_remote', 'hybrid', 'office_only'])->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('glassdoor_url')->nullable();
            $table->string('logo_url')->nullable();
            $table->string('logo_path')->nullable();
            $table->string('cover_image_url')->nullable();
            $table->string('video_url')->nullable();
            $table->json('office_photos')->nullable();
            $table->boolean('onboarding_completed')->default(false);
            $table->timestamp('profile_completed_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('participating_in_career_launch')->default(true);
            $table->json('tags')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};