<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invite_mails', function (Blueprint $table) {
            $table->id();
            $table->string('sender');
            $table->date('masuk')->nullable();
            $table->dateTime('hari')->nullable();
            $table->string('kegiatan');
            $table->string('tempat');
            $table->text('keterangan')->nullable();
            // division_id and status_pelaksanaan are added in the later migration
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invite_mails');
    }
};
