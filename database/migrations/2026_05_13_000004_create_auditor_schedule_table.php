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
        Schema::create('auditor_schedule', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auditor_id')->constrained('auditors')->onDelete('cascade');
            $table->foreignId('invite_mail_id')->constrained('invite_mails')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auditor_schedule');
    }
};
