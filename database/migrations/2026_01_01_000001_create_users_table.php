<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id_user'); // INT UNSIGNED AUTO_INCREMENT
            $table->string('nama', 50)->unique();
            $table->string('email', 255)->unique()->nullable();
            $table->string('password', 255);
            $table->enum('role', ['mahasiswa', 'dosen', 'admin_prodi', 'administrator'])->default('mahasiswa');
            $table->enum('status', ['aktif', 'nonaktif']);
            $table->dateTime('last_login')->nullable();
            $table->string('prodi', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
