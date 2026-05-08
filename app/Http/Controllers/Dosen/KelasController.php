<?php
namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\KelasPerkuliahan;
use App\Models\MataKuliah;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        if (!$dosen) {
            return redirect()->route('dosen.dashboard')->with('error', 'Data dosen tidak ditemukan');
        }

        $id_dosen = $dosen->id_dosen;
        $prodi_dosen = $dosen->prodi;

        $kelas = KelasPerkuliahan::with(['mataKuliah'])
            ->where('id_dosen', $id_dosen)
            ->whereHas('mataKuliah', function($q) use ($prodi_dosen) {
                $q->where(function($sub) use ($prodi_dosen) {
                    $sub->where('prodi', $prodi_dosen)->orWhereNull('prodi');
                });
            })
            ->orderBy('id_kelas', 'desc')
            ->get();

        return view('dosen.kelas', compact('kelas', 'dosen'));
    }
}
