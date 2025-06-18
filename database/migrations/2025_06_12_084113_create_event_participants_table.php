<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('participant_type', ['student', 'company'])->default('student');
            
            // Registration details
            $table->timestamp('registered_at')->default(now());
            $table->enum('status', ['registered', 'confirmed', 'cancelled', 'attended', 'no_show'])->default('registered');
            $table->text('registration_notes')->nullable();
            
            // For companies
            $table->integer('available_positions')->nullable(); // Hoeveel studenten ze kunnen ontvangen
            $table->json('preferred_study_fields')->nullable();
            
            // For students
            $table->json('preferred_companies')->nullable(); // Company IDs die ze willen ontmoeten
            $table->boolean('open_to_all_companies')->default(true);
            
            // Check-in/out
            $table->timestamp('checked_in_at')->nullable();
            $table->timestamp('checked_out_at')->nullable();
            
            $table->timestamps();
            
            $table->unique(['event_id', 'user_id']);
            $table->index(['participant_type', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_participants');
    }
};