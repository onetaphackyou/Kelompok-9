<?php
namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\MataKuliah;
use App\Models\KelasPerkuliahan;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $total_mhs    = Mahasiswa::count();
        $total_dosen  = Dosen::count();
        $total_matkul = MataKuliah::count();
        $total_kelas  = KelasPerkuliahan::count();
        $total_users  = User::count();

        return view('administrator.dashboard', compact('total_mhs', 'total_dosen', 'total_matkul', 'total_kelas', 'total_users'));
    }
}
