// database/migrations/2026_01_01_000004_create_mata_kuliah_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mata_kuliah', function (Blueprint $table) {
            $table->increments('id_matkul');
            $table->string('nama_matkul', 100);
            $table->tinyInteger('sks');
            $table->tinyInteger('semester');
            $table->enum('jenis_matkul', ['Wajib', 'Wajib Univ', 'Pilihan']);
            $table->string('prodi', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mata_kuliah');
    }
};
