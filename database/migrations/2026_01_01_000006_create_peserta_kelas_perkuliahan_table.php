// database/migrations/2026_01_01_000006_create_peserta_kelas_perkuliahan_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peserta_kelas_perkuliahan', function (Blueprint $table) {
            $table->increments('id_peserta');
            $table->unsignedInteger('id_kelas');
            $table->unsignedInteger('id_mhs');
            $table->decimal('nilai_akhir', 5, 2)->nullable();
            $table->timestamps();

            $table->foreign('id_kelas')->references('id_kelas')->on('kelas_perkuliahan')->onDelete('cascade');
            $table->foreign('id_mhs')->references('id_mhs')->on('mahasiswa')->onDelete('cascade');
            $table->unique(['id_kelas', 'id_mhs']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peserta_kelas_perkuliahan');
    }
};
