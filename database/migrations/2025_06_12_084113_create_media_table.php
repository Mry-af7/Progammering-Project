<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            
            // Polymorphic relationship
            $table->morphs('mediable'); // kan user, company, event, etc. zijn
            
            // File details
            $table->string('file_name');
            $table->string('file_path');
            $table->string('disk')->default('public'); // storage disk
            $table->string('mime_type');
            $table->integer('size'); // in bytes
            
            // Media type categorization
            $table->enum('collection', ['profile_images', 'company_logos', 'cvs', 'portfolios', 'event_banners', 'message_attachments'])->default('profile_images');
            
            // Image specific (nullable for non-images)
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            
            // Metadata
            $table->json('metadata')->nullable(); // Alt text, captions, etc.
            $table->integer('sort_order')->default(0);
            
            $table->timestamps();
            
            // Check if the index exists before creating it
            // if (!Schema::hasIndex('media', 'media_mediable_type_mediable_id_index')) {
            //     $table->index(['mediable_type', 'mediable_id'], 'media_mediable_type_mediable_id_index');
            // }
            $table->index(['collection']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};