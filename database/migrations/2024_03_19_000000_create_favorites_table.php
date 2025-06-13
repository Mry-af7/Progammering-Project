<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->morphs('favoritable');
            $table->timestamps();

            // Voorkom dubbele favorieten
            $table->unique(['user_id', 'favoritable_id', 'favoritable_type'], 'unique_favorite');

            // Index voor sneller zoeken
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('favorites');
    }
}; 