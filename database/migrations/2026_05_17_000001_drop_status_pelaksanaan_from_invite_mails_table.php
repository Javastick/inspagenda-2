<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Drop the redundant status_pelaksanaan column from invite_mails.
     * Status is now calculated dynamically at runtime using Carbon.
     */
    public function up(): void
    {
        Schema::table('invite_mails', function (Blueprint $table) {
            $table->dropColumn('status_pelaksanaan');
        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        Schema::table('invite_mails', function (Blueprint $table) {
            $table->string('status_pelaksanaan')->nullable();
        });
    }
};
