<?php

namespace App\Http\Controllers\AdminProdi;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\KelasPerkuliahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index()
    {
        $prodi = Auth::user()->prodi;
        $kelas_list = KelasPerkuliahan::whereHas('dosen', function($q) use ($prodi) {
            $q->where('prodi', $prodi);
        })->with('mataKuliah', 'dosen')->get();

        $jadwal_list = Jadwal::whereIn('id_kelas', $kelas_list->pluck('id_kelas'))
                        ->with('kelas.mataKuliah', 'kelas.dosen')
                        ->orderBy('hari')
                        ->get();

        return view('admin_prodi.jadwal', compact('jadwal_list', 'kelas_list'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'ruangan' => 'required',
            'keterangan' => 'nullable',
        ]);

        Jadwal::create($request->only(['id_kelas', 'hari', 'jam_mulai', 'jam_selesai', 'ruangan', 'keterangan']));

        return redirect()->route('admin_prodi.jadwal')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function destroy($id_jadwal)
    {
        Jadwal::findOrFail($id_jadwal)->delete();
        return redirect()->route('admin_prodi.jadwal')->with('success', 'Jadwal berhasil dihapus!');
    }
}