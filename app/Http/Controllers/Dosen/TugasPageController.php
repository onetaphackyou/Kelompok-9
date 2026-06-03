<?php
namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\KelasPerkuliahan;
use App\Models\TugasPerkuliahan;
use Illuminate\Support\Facades\Auth;

class TugasPageController extends Controller
{
    public function index()
    {
        $id_dosen = Auth::user()->dosen->id_dosen;

        $kelas_list = KelasPerkuliahan::with(['mataKuliah'])
            ->where('id_dosen', $id_dosen)
            ->get();

        $kelas_list->each(function($kelas) {
            $kelas->tugas_list = TugasPerkuliahan::with(['penilaian'])
                ->whereHas('materi', fn($q) => $q->where('id_kelas', $kelas->id_kelas))
                ->get();
        });

        return view('dosen.tugas_page', compact('kelas_list'));
    }
}