<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('profile_completion_percentage')->default(0);
            $table->integer('applications_sent')->default(0);
            $table->integer('applications_pending')->default(0);
            $table->integer('applications_interview')->default(0);
            $table->integer('applications_offers')->default(0);
            $table->integer('profile_views_count')->default(0);
            $table->timestamps();

            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_stats');
    }
}; 