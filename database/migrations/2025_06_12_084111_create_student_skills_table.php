<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('tag_id')->constrained()->onDelete('cascade');
            $table->enum('skill_level', ['beginner', 'intermediate', 'advanced', 'expert'])->default('beginner');
            $table->integer('years_experience')->default(0);
            $table->boolean('is_certified')->default(false);
            $table->string('certification_name')->nullable();
            $table->date('certification_date')->nullable();
            $table->timestamps();
            
            $table->unique(['user_id', 'tag_id']);
            $table->index(['skill_level']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_skills');
    }
};