<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profile_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Section details
            $table->string('section_name'); // "basic_info", "experience", "skills", "portfolio"
            $table->string('display_name'); // "Basic Info", "Experience", "Skills", "Portfolio"
            
            // Completion tracking
            $table->boolean('is_completed')->default(false);
            $table->integer('completion_percentage')->default(0); // 0-100
            $table->timestamp('completed_at')->nullable();
            
            // Requirements
            $table->json('required_fields')->nullable(); // ["firstname", "lastname", "email"]
            $table->json('completed_fields')->nullable(); // ["firstname", "lastname"]
            $table->integer('total_fields')->default(0);
            $table->integer('completed_fields_count')->default(0);
            
            // Metadata
            $table->integer('sort_order')->default(0);
            $table->boolean('is_required')->default(true);
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            
            $table->timestamps();
            
            $table->unique(['user_id', 'section_name']);
            $table->index(['user_id', 'is_completed']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_sections');
    }
};