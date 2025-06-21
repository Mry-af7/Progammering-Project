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
        Schema::table('companies', function (Blueprint $table) {
            // Approval system
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('logo_path');
            $table->timestamp('approved_at')->nullable()->after('status');
            $table->timestamp('rejected_at')->nullable()->after('approved_at');
            $table->unsignedBigInteger('approved_by')->nullable()->after('rejected_at');
            $table->unsignedBigInteger('rejected_by')->nullable()->after('approved_by');
            $table->text('admin_notes')->nullable()->after('rejected_by');
            
            // Profile completion tracking
            $table->boolean('is_complete')->default(false)->after('admin_notes');
            
            // Additional contact/location fields
            $table->string('location')->nullable()->after('is_complete');
            $table->string('size')->nullable()->after('location');
            $table->string('phone')->nullable()->after('size');
            
            // Foreign keys
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('rejected_by')->references('id')->on('users')->onDelete('set null');
            
            // Indexes for performance
            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign(['approved_by']);
            $table->dropForeign(['rejected_by']);
            $table->dropIndex(['status', 'created_at']);
            $table->dropColumn([
                'status',
                'approved_at',
                'rejected_at', 
                'approved_by',
                'rejected_by',
                'admin_notes',
                'is_complete',
                'location',
                'size',
                'phone'
            ]);
        });
    }
};