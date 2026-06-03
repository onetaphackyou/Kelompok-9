<?php
namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\KelasPerkuliahan;
use App\Models\TugasPerkuliahan;
use App\Models\Penilaian;
use Illuminate\Support\Facades\Auth;

class TugasPageController extends Controller
{
    public function index()
    {
        $id_mhs = Auth::user()->mahasiswa->id_mhs;

        $kelas_list = KelasPerkuliahan::with(['mataKuliah'])
            ->whereHas('peserta', fn($q) => $q->where('id_mhs', $id_mhs))
            ->get();

        $kelas_list->each(function($kelas) use ($id_mhs) {
            $kelas->tugas_list = TugasPerkuliahan::with(['penilaian' => fn($q) => $q->where('id_mhs', $id_mhs)])
                ->whereHas('materi', fn($q) => $q->where('id_kelas', $kelas->id_kelas))
                ->get();
        });

        return view('mahasiswa.tugas_page', compact('kelas_list'));
    }
}