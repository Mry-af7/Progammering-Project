<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // "JavaScript", "Remote Work", "Startup"
            $table->string('slug')->unique(); // "javascript", "remote-work", "startup"
            $table->enum('type', ['skill', 'technology', 'industry', 'culture', 'benefit'])->default('skill');
            $table->string('color')->default('#3B82F6'); // Hex color voor display
            $table->text('description')->nullable();
            $table->boolean('is_popular')->default(false); // Voor featured tags
            $table->integer('usage_count')->default(0); // Hoeveel keer gebruikt
            $table->timestamps();
            
            $table->index(['type']);
            $table->index(['is_popular']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};