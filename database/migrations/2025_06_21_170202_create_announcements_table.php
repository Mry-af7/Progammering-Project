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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            
            // Announcement content
            $table->string('title');
            $table->longText('content');
            $table->enum('type', ['info', 'success', 'warning', 'error', 'urgent'])->default('info');
            $table->integer('priority')->default(1);
            
            // Visibility settings
            $table->boolean('is_active')->default(true);
            $table->boolean('show_on_dashboard')->default(true);
            $table->boolean('show_on_homepage')->default(false);
            $table->json('target_audience')->nullable(); // ['students', 'companies', 'all']
            
            // Scheduling
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('starts_at')->nullable();
            
            // Call to action
            $table->string('action_url')->nullable();
            $table->string('action_text')->nullable();
            $table->boolean('dismissible')->default(true);
            
            // Analytics
            $table->integer('views')->default(0);
            $table->integer('clicks')->default(0);
            
            // Tracking
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            
            // Indexes
            $table->index(['is_active', 'starts_at', 'expires_at']);
            $table->index(['priority', 'created_at']);
            $table->index(['show_on_dashboard', 'show_on_homepage']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};