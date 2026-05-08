// database/migrations/2026_01_01_000005_create_kelas_perkuliahan_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas_perkuliahan', function (Blueprint $table) {
            $table->increments('id_kelas');
            $table->string('nama_kelas', 50);
            $table->unsignedInteger('id_matkul');
            $table->unsignedInteger('id_dosen');
            $table->string('ruangan', 30)->nullable();
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'])->nullable();
            $table->time('jam_awal');
            $table->time('jam_akhir');
            $table->string('periode', 25);
            $table->timestamps();

            $table->foreign('id_matkul')->references('id_matkul')->on('mata_kuliah')->onDelete('cascade');
            $table->foreign('id_dosen')->references('id_dosen')->on('dosen')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas_perkuliahan');
    }
};
