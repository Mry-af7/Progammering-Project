<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(); // Optionele titel
            $table->enum('type', ['private', 'group', 'announcement'])->default('private');
            
            // Status
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_message_at')->nullable();
            
            // Metadata
            $table->json('metadata')->nullable(); // Extra data zoals group settings
            
            $table->timestamps();
            
            $table->index(['last_message_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};