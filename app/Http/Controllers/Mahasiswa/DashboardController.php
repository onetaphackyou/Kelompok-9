<?php
namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\PesertaKelasPerkuliahan;
use App\Models\MateriPerkuliahan;
use App\Models\TugasPerkuliahan;
use App\Models\Penilaian;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $id_mhs = Auth::user()->mahasiswa->id_mhs;

        $kelas_count = PesertaKelasPerkuliahan::where('id_mhs', $id_mhs)->count();
        $materi_count = MateriPerkuliahan::whereHas('kelas.peserta', fn($q) => $q->where('id_mhs', $id_mhs))->count();
        $tugas_count = TugasPerkuliahan::whereHas('materi.kelas.peserta', fn($q) => $q->where('id_mhs', $id_mhs))->count();
        $tugas_pending = Penilaian::where('id_mhs', $id_mhs)->where('status', 'belum diserahkan')->count();
        $penilaian_count = Penilaian::where('id_mhs', $id_mhs)->count();

        return view('mahasiswa.dashboard', compact('kelas_count', 'materi_count', 'tugas_count', 'tugas_pending', 'penilaian_count'));
    }
}
