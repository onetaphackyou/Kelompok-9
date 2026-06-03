<?php
namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\PesertaKelasPerkuliahan;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index()
    {
        $id_mhs = Auth::user()->mahasiswa->id_mhs;

        $id_kelas_list = PesertaKelasPerkuliahan::where('id_mhs', $id_mhs)
            ->pluck('id_kelas');

        $jadwal_list = Jadwal::whereIn('id_kelas', $id_kelas_list)
            ->with('kelas.mataKuliah', 'kelas.dosen')
            ->orderBy('hari')
            ->get();

        return view('mahasiswa.jadwal', compact('jadwal_list'));
    }
}