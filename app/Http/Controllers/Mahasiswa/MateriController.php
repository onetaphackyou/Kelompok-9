<?php
namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\KelasPerkuliahan;
use App\Models\MateriPerkuliahan;
use App\Models\PesertaKelasPerkuliahan;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
    public function index()
    {
        $id_mhs = Auth::user()->mahasiswa->id_mhs;

        $kelas_list = KelasPerkuliahan::with(['mataKuliah', 'materi'])
            ->whereHas('peserta', fn($q) => $q->where('id_mhs', $id_mhs))
            ->get();

        return view('mahasiswa.materi', compact('kelas_list'));
    }
}