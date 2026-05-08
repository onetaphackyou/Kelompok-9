<?php
namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\PesertaKelasPerkuliahan;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    public function index()
    {
        $id_mhs = Auth::user()->mahasiswa->id_mhs;
        $kelas = PesertaKelasPerkuliahan::with('kelas.mataKuliah', 'kelas.dosen')
            ->where('id_mhs', $id_mhs)
            ->get()
            ->pluck('kelas'); // ambil objek kelas

        return view('mahasiswa.kelas', compact('kelas'));
    }
}
