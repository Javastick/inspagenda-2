<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('auditors', function (Blueprint $table) {
            if (Schema::hasColumn('auditors', 'status')) {
                $table->dropColumn('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('auditors', function (Blueprint $table) {
            if (!Schema::hasColumn('auditors', 'status')) {
                $table->string('status')->default('active');
            }
        });
    }
};
