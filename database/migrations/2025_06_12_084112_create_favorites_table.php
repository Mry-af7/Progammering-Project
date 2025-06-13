<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Wie heeft favorite gemaakt
            
            // Polymorphic relationship - kan student OF company zijn
            $table->morphs('favoritable'); // favoritable_type (User/Company), favoritable_id
            
            // Metadata
            $table->text('notes')->nullable(); // Persoonlijke notities
            $table->json('tags')->nullable(); // Custom tags ["interesting", "follow-up"]
            
            $table->timestamps();
            
            $table->unique(['user_id', 'favoritable_type', 'favoritable_id']);
            $table->index(['user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};