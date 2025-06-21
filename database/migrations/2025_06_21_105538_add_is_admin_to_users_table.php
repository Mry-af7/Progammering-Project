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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false)->after('user_type');
            $table->timestamp('admin_granted_at')->nullable()->after('is_admin');
            $table->unsignedBigInteger('admin_granted_by')->nullable()->after('admin_granted_at');
            
            // Optional: Add foreign key constraint if you want to track who granted admin
            $table->foreign('admin_granted_by')->references('id')->on('users')->onDelete('set null');
            
            // Add index for faster queries
            $table->index('is_admin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['admin_granted_by']);
            $table->dropIndex(['is_admin']);
            $table->dropColumn(['is_admin', 'admin_granted_at', 'admin_granted_by']);
        });
    }
};