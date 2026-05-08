// database/migrations/2026_01_01_000008_create_tugas_perkuliahan_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tugas_perkuliahan', function (Blueprint $table) {
            $table->increments('id_tugas');
            $table->unsignedInteger('id_materi');
            $table->string('judul_tugas', 150);
            $table->text('deskripsi_tugas')->nullable();
            $table->string('file_tugas', 255)->nullable();
            $table->datetime('deadline');
            $table->timestamps();

            $table->foreign('id_materi')->references('id_materi')->on('materi_perkuliahan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tugas_perkuliahan');
    }
};
