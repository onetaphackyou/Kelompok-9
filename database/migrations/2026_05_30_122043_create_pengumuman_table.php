<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('pengumuman', function (Blueprint $table) {
        $table->id('id_pengumuman');
        $table->unsignedBigInteger('id_kelas');
        $table->unsignedBigInteger('id_dosen');
        $table->string('judul');
        $table->text('isi');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('pengumuman');
    }
};