<?php

namespace App\Http\Controllers\Administrator; 

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\KelasPerkuliahan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Administrator melihat semua data (tanpa filter prodi)
        $total_mahasiswa = Mahasiswa::count();
        $total_dosen = Dosen::count();
        $total_matkul = MataKuliah::count();
        $total_kelas = KelasPerkuliahan::count();

        return view('administrator.dashboard', compact(
            'total_mahasiswa', 'total_dosen', 'total_matkul', 'total_kelas'
        ));
    }
}
