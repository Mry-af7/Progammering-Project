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
            // Admin system fields
            $table->boolean('is_admin')->default(false)->after('password');
            $table->timestamp('admin_granted_at')->nullable()->after('is_admin');
            $table->unsignedBigInteger('admin_granted_by')->nullable()->after('admin_granted_at');
            
            // Analytics fields
            $table->timestamp('last_login_at')->nullable()->after('admin_granted_by');
            $table->integer('login_count')->default(0)->after('last_login_at');
            
            // Foreign key for admin_granted_by
            $table->foreign('admin_granted_by')->references('id')->on('users')->onDelete('set null');
            
            // Index for performance
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
            $table->dropColumn([
                'is_admin',
                'admin_granted_at', 
                'admin_granted_by',
                'last_login_at',
                'login_count'
            ]);
        });
    }
};