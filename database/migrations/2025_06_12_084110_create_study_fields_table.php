<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('study_fields', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // "Multimedia & Creatieve Technologie"
            $table->string('code')->unique(); // "MCT"
            $table->text('description')->nullable();
            $table->string('department')->nullable(); // "Design & Technologie"
            $table->enum('level', ['bachelor', 'master', 'graduate'])->default('bachelor');
            $table->integer('duration_years')->default(3);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('study_fields');
    }
};