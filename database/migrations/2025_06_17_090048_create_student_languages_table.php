<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('student_languages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('language_id')->constrained()->onDelete('cascade');
            $table->enum('fluency_level', ['Basic', 'Conversational', 'Business', 'Fluent', 'Native']);
            $table->timestamps();
            
            $table->unique(['student_id', 'language_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_languages');
    }
};