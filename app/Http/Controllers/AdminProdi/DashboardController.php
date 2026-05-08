// app/Http/Controllers/AdminProdi/DashboardController.php
<?php

namespace App\Http\Controllers\AdminProdi;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\KelasPerkuliahan;
use App\Models\PesertaKelasPerkuliahan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $admin_prodi = Auth::user()->prodi;

        $total_mhs = Mahasiswa::where('prodi', $admin_prodi)->count();
        $total_dosen = Dosen::where('prodi', $admin_prodi)->count();
        $total_matkul = MataKuliah::count();
        $total_kelas = KelasPerkuliahan::whereHas('dosen', function($q) use ($admin_prodi) {
            $q->where('prodi', $admin_prodi);
        })->count();
        $total_peserta = PesertaKelasPerkuliahan::whereHas('kelas.dosen', function($q) use ($admin_prodi) {
            $q->where('prodi', $admin_prodi);
        })->count();

        return view('admin_prodi.dashboard', compact(
            'total_mhs', 'total_dosen', 'total_matkul', 'total_kelas', 'total_peserta', 'admin_prodi'
        ));
    }
}
