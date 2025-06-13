<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // "Microsoft Belgium"
            $table->string('slug')->unique(); // "microsoft-belgium"
            $table->text('description');
            $table->string('logo')->nullable();
            $table->string('website')->nullable();
            
            // Contact info
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->default('Belgium');
            
            // Company details
            $table->enum('company_size', ['startup', 'small', 'medium', 'large', 'enterprise'])->nullable();
            $table->string('industry')->nullable();
            $table->year('founded_year')->nullable();
            
            // Platform status
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_active')->default(true);
            $table->boolean('accepts_students')->default(true);
            
            // Event participation
            $table->boolean('participates_in_events')->default(false);
            $table->json('preferred_study_fields')->nullable(); // Array van study field IDs
            
            $table->timestamps();
            
            $table->index(['is_active', 'accepts_students']);
            $table->index(['industry']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};