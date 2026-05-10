<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id_user');
            $table->string('nama', 50)->unique();
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->enum('role', ['mahasiswa', 'dosen', 'admin_prodi', 'administrator'])->default('mahasiswa');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->datetime('last_login')->nullable();
            $table->string('prodi', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
