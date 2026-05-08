// database/migrations/2026_01_01_000002_create_dosen_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dosen', function (Blueprint $table) {
            $table->increments('id_dosen');
            $table->unsignedInteger('id_user');
            $table->string('nip', 30)->unique();
            $table->string('nama', 100);
            $table->string('prodi', 50);
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('agama', 20)->nullable();
            $table->string('jenis_jabatan', 50)->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dosen');
    }
};
