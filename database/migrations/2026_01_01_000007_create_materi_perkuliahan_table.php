// database/migrations/2026_01_01_000007_create_materi_perkuliahan_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materi_perkuliahan', function (Blueprint $table) {
            $table->increments('id_materi');
            $table->unsignedInteger('id_kelas');
            $table->string('judul_materi', 150);
            $table->text('deskripsi')->nullable();
            $table->string('upload_file', 255)->nullable();
            $table->timestamps();

            $table->foreign('id_kelas')->references('id_kelas')->on('kelas_perkuliahan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materi_perkuliahan');
    }
};
