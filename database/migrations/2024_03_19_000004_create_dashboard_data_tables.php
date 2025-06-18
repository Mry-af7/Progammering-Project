<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Career Goals Table
        Schema::create('career_goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->integer('progress')->default(0);
            $table->date('target_date')->nullable();
            $table->timestamps();
            
            $table->index(['user_id', 'target_date']);
        });

        // Skills Table (if not exists)
        if (!Schema::hasTable('skills')) {
            Schema::create('skills', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('name');
                $table->integer('level');
                $table->string('category')->nullable();
                $table->timestamps();
                
                $table->index(['user_id', 'category']);
            });
        }

        // Recommended Skills Table
        Schema::create('recommended_skills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('demand');
            $table->string('category');
            $table->timestamps();
            
            $table->index('category');
        });

        // Networking Connections Table
        Schema::create('networking_connections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('position');
            $table->string('company');
            $table->string('avatar')->nullable();
            $table->integer('mutual_connections')->default(0);
            $table->boolean('is_connected')->default(false);
            $table->timestamps();
            
            $table->index(['user_id', 'company']);
        });

        // Dashboard Events Table (separate from main events)
        Schema::create('dashboard_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->dateTime('event_date');
            $table->string('location');
            $table->string('icon')->nullable();
            $table->boolean('is_today')->default(false);
            $table->timestamps();
            
            $table->index(['user_id', 'event_date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('dashboard_events');
        Schema::dropIfExists('networking_connections');
        Schema::dropIfExists('recommended_skills');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('career_goals');
    }
}; 