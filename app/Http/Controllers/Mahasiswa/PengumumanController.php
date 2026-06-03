<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use App\Models\KelasPerkuliahan;
use Illuminate\Support\Facades\Auth;

class PengumumanController extends Controller
{
    public function index($id_kelas)
    {
        $id_mhs = Auth::user()->mahasiswa->id_mhs;

        $kelas = KelasPerkuliahan::whereHas('peserta', fn($q) => $q->where('id_mhs', $id_mhs))
                    ->where('id_kelas', $id_kelas)
                    ->firstOrFail();

        $pengumuman = Pengumuman::where('id_kelas', $id_kelas)
                        ->orderByDesc('created_at')
                        ->get();

        return view('mahasiswa.pengumuman', compact('kelas', 'pengumuman', 'id_kelas'));
    }
}