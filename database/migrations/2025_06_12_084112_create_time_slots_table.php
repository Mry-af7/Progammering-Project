<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('time_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            
            // Time details
            $table->time('start_time'); // 09:00
            $table->time('end_time');   // 09:15
            $table->integer('duration_minutes')->default(15);
            
            // Capacity
            $table->integer('max_students')->default(1); // Voor speeddate meestal 1
            $table->integer('current_bookings')->default(0);
            
            // Status
            $table->boolean('is_available')->default(true);
            $table->enum('status', ['available', 'booked', 'completed', 'cancelled'])->default('available');
            
            // Location binnen event
            $table->string('room')->nullable(); // "Room A", "Table 5"
            $table->text('special_instructions')->nullable();
            
            $table->timestamps();
            
            $table->index(['event_id', 'start_time']);
            $table->index(['company_id', 'is_available']);
            $table->unique(['event_id', 'company_id', 'start_time']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('time_slots');
    }
};