<?php
namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\KelasPerkuliahan;
use App\Models\MateriPerkuliahan;
use App\Models\TugasPerkuliahan;
use Illuminate\Support\Facades\Auth;

class DetailKelasController extends Controller
{
    public function show($id_kelas)
    {
        $id_mhs = Auth::user()->mahasiswa->id_mhs;

        $kelas = KelasPerkuliahan::with('mataKuliah', 'dosen')
            ->whereHas('peserta', fn($q) => $q->where('id_mhs', $id_mhs))
            ->where('id_kelas', $id_kelas)
            ->firstOrFail();

        $materi_list = MateriPerkuliahan::where('id_kelas', $id_kelas)->orderByDesc('id_materi')->get();

        $tugas_list = TugasPerkuliahan::with(['materi', 'penilaian' => function($q) use ($id_mhs) {
            $q->where('id_mhs', $id_mhs);
        }])
        ->whereHas('materi', fn($q) => $q->where('id_kelas', $id_kelas))
        ->orderByDesc('deadline')
        ->get();

        return view('mahasiswa.detail', compact('kelas', 'materi_list', 'tugas_list'));
    }
}
