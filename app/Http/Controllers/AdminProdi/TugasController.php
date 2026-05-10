<?php

namespace App\Http\Controllers\AdminProdi;

use App\Http\Controllers\Controller;
use App\Models\TugasPerkuliahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    public function index(Request $request)
    {
        $admin_prodi = Auth::user()->prodi;
        $id_kelas = $request->get('id_kelas', 0);

        $tugas_list = TugasPerkuliahan::with(['materi'])
            ->whereHas('materi', function ($q) use ($id_kelas) {
                $q->where('id_kelas', $id_kelas);
            })
            ->withCount(['penilaian as jumlah_diserahkan' => function ($q) {
                $q->where('status', 'diserahkan');
            }])
            ->withCount(['penilaian as jumlah_dinilai' => function ($q) {
                $q->whereNotNull('nilai');
            }])
            ->orderBy('deadline', 'desc')
            ->get();

        $total_peserta = \App\Models\PesertaKelasPerkuliahan::where('id_kelas', $id_kelas)->count();

        return view('admin_prodi.tugas', compact('tugas_list', 'id_kelas', 'admin_prodi', 'total_peserta'));
    }
}

