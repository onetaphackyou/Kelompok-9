<?php
namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\KelasPerkuliahan;
use App\Models\PesertaKelasPerkuliahan;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index()
    {
        $id_mhs = Auth::user()->mahasiswa->id_mhs;

        $nilai_list = PesertaKelasPerkuliahan::with(['kelas.mataKuliah', 'kelas.dosen'])
            ->where('id_mhs', $id_mhs)
            ->get();

        return view('mahasiswa.nilai', compact('nilai_list'));
    }
}