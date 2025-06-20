<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('student_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('skill_id')->constrained()->onDelete('cascade');
            $table->enum('proficiency_level', ['Beginner', 'Intermediate', 'Advanced', 'Expert']);
            $table->timestamps();
            
            $table->unique(['student_id', 'skill_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_skills');
    }
};