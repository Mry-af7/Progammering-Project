<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Check if companies table exists before trying to add columns
        if (Schema::hasTable('companies')) {
            Schema::table('companies', function (Blueprint $table) {
                // Check if columns exist before adding them
                if (!Schema::hasColumn('companies', 'is_active')) {
                    $table->boolean('is_active')->default(true);
                }
                if (!Schema::hasColumn('companies', 'participating_in_career_launch')) {
                    $table->boolean('participating_in_career_launch')->default(true);
                }
                if (!Schema::hasColumn('companies', 'tags')) {
                    $table->json('tags')->nullable();
                }
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('companies')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->dropColumn(['is_active', 'participating_in_career_launch', 'tags']);
            });
        }
    }
}; 