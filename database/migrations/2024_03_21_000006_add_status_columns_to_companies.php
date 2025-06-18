<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->boolean('is_active')->default(true);
            $table->boolean('participating_in_career_launch')->default(true);
            $table->json('tags')->nullable();
        });
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn(['is_active', 'participating_in_career_launch', 'tags']);
        });
    }
}; 