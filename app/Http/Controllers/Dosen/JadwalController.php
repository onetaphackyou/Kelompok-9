<?php
namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\KelasPerkuliahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index()
    {
        $id_dosen = Auth::user()->dosen->id_dosen;

        $kelas_list = KelasPerkuliahan::with('mataKuliah')
            ->where('id_dosen', $id_dosen)
            ->get();

        $jadwal_list = Jadwal::whereIn('id_kelas', $kelas_list->pluck('id_kelas'))
            ->with('kelas.mataKuliah')
            ->orderBy('hari')
            ->get();

        return view('dosen.jadwal', compact('jadwal_list', 'kelas_list'));
    }

    public function update(Request $request, $id_jadwal)
    {
        $request->validate([
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'ruangan' => 'required',
            'keterangan' => 'nullable',
        ]);

        $jadwal = Jadwal::findOrFail($id_jadwal);
        $jadwal->update($request->only(['hari', 'jam_mulai', 'jam_selesai', 'ruangan', 'keterangan']));

        return redirect()->route('dosen.jadwal')->with('success', 'Jadwal berhasil diperbarui!');
    }
}