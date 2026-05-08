<?php
namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\KelasPerkuliahan;
use App\Models\MateriPerkuliahan;
use App\Models\PesertaKelasPerkuliahan;
use App\Models\TugasPerkuliahan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        if (!$dosen) {
            return redirect()->route('dosen.kelas')->with('error', 'Data dosen tidak ditemukan');
        }

        $id_dosen = $dosen->id_dosen;

        $kelas_count = KelasPerkuliahan::where('id_dosen', $id_dosen)->count();
        $mhs_count = PesertaKelasPerkuliahan::whereHas('kelas', function($q) use ($id_dosen) {
            $q->where('id_dosen', $id_dosen);
        })->count();
        $materi_count = MateriPerkuliahan::whereHas('kelas', function($q) use ($id_dosen) {
            $q->where('id_dosen', $id_dosen);
        })->count();
        $tugas_count = TugasPerkuliahan::whereHas('materi.kelas', function($q) use ($id_dosen) {
            $q->where('id_dosen', $id_dosen);
        })->count();

        return view('dosen.dashboard', compact('dosen', 'kelas_count', 'mhs_count', 'materi_count', 'tugas_count'));
    }
}
