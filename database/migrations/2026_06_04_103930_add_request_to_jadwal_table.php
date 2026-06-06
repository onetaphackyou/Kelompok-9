<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwal', function (Blueprint $table) {
            $table->string('hari_request')->nullable();
            $table->time('jam_mulai_request')->nullable();
            $table->time('jam_selesai_request')->nullable();
            $table->string('ruangan_request')->nullable();
            $table->string('keterangan_request')->nullable();
            $table->enum('status_request', ['none', 'pending', 'approved', 'rejected'])->default('none');
            $table->unsignedBigInteger('id_dosen_request')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('jadwal', function (Blueprint $table) {
            $table->dropColumn([
                'hari_request', 'jam_mulai_request', 'jam_selesai_request',
                'ruangan_request', 'keterangan_request', 'status_request', 'id_dosen_request'
            ]);
        });
    }
};