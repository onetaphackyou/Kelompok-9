<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('jadwal', function (Blueprint $table) {
        $table->id('id_jadwal');
        $table->unsignedBigInteger('id_kelas');
        $table->string('hari');
        $table->time('jam_mulai');
        $table->time('jam_selesai');
        $table->string('ruangan');
        $table->string('keterangan')->nullable();
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};