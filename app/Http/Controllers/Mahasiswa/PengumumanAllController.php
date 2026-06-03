<?php
namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use App\Models\PesertaKelasPerkuliahan;
use Illuminate\Support\Facades\Auth;

class PengumumanAllController extends Controller
{
    public function index()
    {
        $id_mhs = Auth::user()->mahasiswa->id_mhs;

        $id_kelas_list = PesertaKelasPerkuliahan::where('id_mhs', $id_mhs)
            ->pluck('id_kelas');

        $pengumuman_list = Pengumuman::whereIn('id_kelas', $id_kelas_list)
            ->with('kelas.mataKuliah', 'dosen')
            ->orderByDesc('created_at')
            ->get();

        return view('mahasiswa.pengumuman_all', compact('pengumuman_list'));
    }
}