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
        Schema::table('students', function (Blueprint $table) {
            // Enhanced academic info
            $table->string('course')->nullable()->after('about_me');
            $table->integer('year')->nullable()->after('course');
            $table->text('bio')->nullable()->after('year');
            $table->string('university')->nullable()->after('bio');
            $table->integer('graduation_year')->nullable()->after('university');
            $table->decimal('gpa', 3, 2)->nullable()->after('graduation_year');
            
            // Contact and location
            $table->string('phone')->nullable()->after('gpa');
            $table->string('location')->nullable()->after('phone');
            
            // Work preferences
            $table->boolean('available_for_work')->default(true)->after('location');
            $table->string('preferred_work_type')->nullable()->after('available_for_work');
            $table->integer('salary_expectation')->nullable()->after('preferred_work_type');
            
            // File paths
            $table->string('portfolio_url')->nullable()->after('salary_expectation');
            $table->string('resume_path')->nullable()->after('portfolio_url');
            $table->string('profile_photo_path')->nullable()->after('resume_path');
            
            // Admin features
            $table->boolean('is_active')->default(true)->after('profile_photo_path');
            $table->boolean('featured')->default(false)->after('is_active');
            $table->text('admin_notes')->nullable()->after('featured');
            
            // Indexes for performance
            $table->index(['is_active', 'available_for_work']);
            $table->index(['graduation_year', 'university']);
            $table->index('featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropIndex(['is_active', 'available_for_work']);
            $table->dropIndex(['graduation_year', 'university']);
            $table->dropIndex(['featured']);
            $table->dropColumn([
                'course',
                'year',
                'bio',
                'university',
                'graduation_year',
                'gpa',
                'phone',
                'location',
                'available_for_work',
                'preferred_work_type',
                'salary_expectation',
                'portfolio_url',
                'resume_path',
                'profile_photo_path',
                'is_active',
                'featured',
                'admin_notes'
            ]);
        });
    }
};