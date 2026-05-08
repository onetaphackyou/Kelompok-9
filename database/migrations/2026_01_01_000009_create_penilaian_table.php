// database/migrations/2026_01_01_000009_create_penilaian_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->increments('id_nilai');
            $table->unsignedInteger('id_tugas');
            $table->unsignedInteger('id_mhs');
            $table->unsignedInteger('id_peserta');
            $table->decimal('nilai', 5, 2)->nullable();
            $table->string('upload_file', 255)->nullable();
            $table->enum('status', ['diserahkan', 'belum diserahkan'])->default('belum diserahkan');
            $table->timestamps();

            $table->foreign('id_tugas')->references('id_tugas')->on('tugas_perkuliahan')->onDelete('cascade');
            $table->foreign('id_mhs')->references('id_mhs')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('id_peserta')->references('id_peserta')->on('peserta_kelas_perkuliahan')->onDelete('cascade');
            $table->unique(['id_tugas', 'id_mhs']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penilaian');
    }
};
