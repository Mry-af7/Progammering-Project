<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('year_of_study')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('custom_link_url')->nullable();
            $table->string('custom_link_title')->nullable(); // e.g., "Personal Website", "Twitter"
            $table->text('about_me')->nullable();
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn([
                'year_of_study',
                'linkedin_url', 
                'custom_link_url',
                'custom_link_title',
                'about_me'
            ]);
        });
    }
};