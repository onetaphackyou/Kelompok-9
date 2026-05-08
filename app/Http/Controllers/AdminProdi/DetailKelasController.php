// app/Http/Controllers/AdminProdi/DetailKelasController.php
<?php

namespace App\Http\Controllers\AdminProdi;

use App\Http\Controllers\Controller;
use App\Models\KelasPerkuliahan;
use App\Models\MateriPerkuliahan;
use App\Models\TugasPerkuliahan;
use Illuminate\Support\Facades\Auth;

class DetailKelasController extends Controller
{
    public function show($id_kelas)
    {
        $admin_prodi = Auth::user()->prodi;

        $kelas_info = KelasPerkuliahan::with(['mataKuliah', 'dosen'])
            ->where('id_kelas', $id_kelas)
            ->whereHas('dosen', function($q) use ($admin_prodi) {
                $q->where('prodi', $admin_prodi);
            })
            ->firstOrFail();

        $materi_list = MateriPerkuliahan::withCount('tugas')
            ->where('id_kelas', $id_kelas)
            ->orderBy('id_materi', 'desc')
            ->get();

        $tugas_list = TugasPerkuliahan::with(['materi'])
            ->whereHas('materi', function($q) use ($id_kelas) {
                $q->where('id_kelas', $id_kelas);
            })
            ->withCount(['penilaian as jumlah_diserahkan' => function($q) {
                $q->where('status', 'diserahkan');
            }])
            ->withCount(['penilaian as jumlah_dinilai' => function($q) {
                $q->whereNotNull('nilai');
            }])
            ->orderBy('deadline', 'desc')
            ->get();

        // Get total peserta count
        $total_peserta = \App\Models\PesertaKelasPerkuliahan::where('id_kelas', $id_kelas)->count();

        return view('admin_prodi.detail', compact('kelas_info', 'materi_list', 'tugas_list', 'admin_prodi', 'id_kelas', 'total_peserta'));
    }
}
