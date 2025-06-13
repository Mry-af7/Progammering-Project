<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // "Career Launch 2025"
            $table->text('description');
            $table->enum('type', ['career_fair', 'speeddate', 'workshop', 'presentation', 'networking'])->default('speeddate');
            
            // Date & Time
            $table->date('event_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('timezone')->default('Europe/Brussels');
            
            // Location
            $table->string('location');
            $table->string('address')->nullable();
            $table->string('room')->nullable();
            
            // Registration
            $table->integer('max_participants')->nullable();
            $table->integer('max_companies')->nullable();
            $table->date('registration_deadline');
            $table->enum('status', ['draft', 'registration_open', 'registration_closed', 'ongoing', 'completed', 'cancelled'])->default('draft');
            
            // Requirements
            $table->json('target_study_fields')->nullable(); // Array van study field IDs
            $table->json('target_study_years')->nullable(); // [2, 3] voor 2e en 3e jaar
            $table->boolean('requires_approval')->default(false);
            
            // Event details
            $table->text('instructions')->nullable(); // Instructies voor deelnemers
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            
            // Images
            $table->string('banner_image')->nullable();
            $table->json('gallery_images')->nullable();
            
            $table->timestamps();
            
            $table->index(['event_date', 'status']);
            $table->index(['type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};