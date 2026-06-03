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
        if (!Auth::user()->mahasiswa) {
            return redirect()->route('mahasiswa.complete_profile');
        }

        $id_mhs = Auth::user()->mahasiswa->id_mhs;

        $kelas_count = PesertaKelasPerkuliahan::where('id_mhs', $id_mhs)->count();
        $materi_count = MateriPerkuliahan::whereHas('kelas.peserta', fn($q) => $q->where('id_mhs', $id_mhs))->count();
        $tugas_count = TugasPerkuliahan::whereHas('materi.kelas.peserta', fn($q) => $q->where('id_mhs', $id_mhs))->count();
        
        // Tugas yang sudah dikumpulkan
        $tugas_selesai = Penilaian::where('id_mhs', $id_mhs)->where('status', 'diserahkan')->count();
        
        // Tugas pending = total tugas - yang sudah dikumpulkan
        $tugas_pending = $tugas_count - $tugas_selesai;
        
        // Nilai rata-rata
        $nilai_rata = Penilaian::where('id_mhs', $id_mhs)->whereNotNull('nilai')->avg('nilai');
        $nilai_rata = $nilai_rata ? round($nilai_rata, 1) : 0;

        $penilaian_count = $tugas_selesai;

        return view('mahasiswa.dashboard', compact(
            'kelas_count', 'materi_count', 'tugas_count',
            'tugas_selesai', 'tugas_pending', 'nilai_rata', 'penilaian_count'
        ));
    }
}