<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('time_slot_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            
            // Student info (snapshot bij booking)
            $table->string('student_firstname');
            $table->string('student_lastname');
            $table->string('student_email');
            $table->string('student_phone')->nullable();
            $table->string('study_field');
            $table->integer('study_year');
            
            // Appointment details
            $table->text('student_notes')->nullable(); // Wat de student wil bespreken
            $table->text('company_notes')->nullable(); // Notities van het bedrijf
            $table->integer('rating_by_student')->nullable(); // 1-5 sterren
            $table->integer('rating_by_company')->nullable(); // 1-5 sterren
            $table->text('feedback_student')->nullable();
            $table->text('feedback_company')->nullable();
            
            // Status tracking
            $table->enum('status', ['confirmed', 'student_cancelled', 'company_cancelled', 'no_show_student', 'no_show_company', 'completed'])->default('confirmed');
            $table->timestamp('confirmed_at')->default(now());
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            
            // Follow-up
            $table->boolean('follow_up_requested')->default(false);
            $table->text('follow_up_notes')->nullable();
            
            $table->timestamps();
            
            $table->index(['student_id']);
            $table->index(['status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};