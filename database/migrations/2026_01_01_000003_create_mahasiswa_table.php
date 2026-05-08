// database/migrations/2026_01_01_000003_create_mahasiswa_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->increments('id_mhs');
            $table->unsignedInteger('id_user');
            $table->string('nim', 20)->unique();
            $table->string('nama', 100)->nullable();
            $table->string('tempat_lahir', 50)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('agama', 20)->nullable();
            $table->string('prodi', 50)->nullable();
            $table->string('periode', 25)->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
