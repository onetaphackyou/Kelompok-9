<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\KelasPerkuliahan;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin Prodi TI
        $adminProdi = User::create([
            'nama' => 'Admin',
            'email' => 'admin.ti@prodi.com',
            'password' => bcrypt('prodi123'),
            'role' => 'admin_prodi',
            'status' => 'aktif',
            'prodi' => 'Teknik Informatika'
        ]);

        // Dosen
        $dosenUser = User::create([
            'nama' => 'Dr. Bambang',
            'email' => 'dosen@ti.com',
            'password' => bcrypt('dosen123'),
            'role' => 'dosen',
            'status' => 'aktif',
            'prodi' => 'Teknik Informatika'
        ]);
        Dosen::create([
            'id_user' => $dosenUser->id_user,
            'nip' => '1234567890',
            'nama' => 'Dr. Bambang Setiawan',
            'prodi' => 'Teknik Informatika',
            'jenis_kelamin' => 'L'
        ]);

        // Mahasiswa
        $mhsUser = User::create([
            'nama' => 'Willenstein',
            'email' => 'mhs1@ti.com',
            'password' => bcrypt('mhs123'),
            'role' => 'mahasiswa',
            'status' => 'aktif',
            'prodi' => 'Teknik Informatika'
        ]);
        Mahasiswa::create([
            'id_user' => $mhsUser->id_user,
            'nim' => '2402310053',
            'nama' => 'Willenstein',
            'prodi' => 'Teknik Informatika',
            'periode' => '2025/2026'
        ]);

        // Sample data
        $matkul = MataKuliah::create([
            'nama_matkul' => 'Web Programming',
            'sks' => 3,
            'semester' => 5,
            'prodi' => 'Teknik Informatika'
        ]);

        KelasPerkuliahan::create([
            'nama_kelas' => 'A1',
            'id_matkul' => $matkul->id_matkul,
            'id_dosen' => $dosenUser->id_user,
            'ruangan' => 'Lab 1',
            'hari' => 'Senin',
            'jam_awal' => '08:00:00',
            'jam_akhir' => '10:00:00',
            'periode' => '2025/2026'
        ]);
    }
}

