<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('company_sizes', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "1-10 employees"
            $table->string('label'); // e.g., "Startup"
            $table->integer('min_employees');
            $table->integer('max_employees')->nullable(); // null for "500+" 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_sizes');
    }
};