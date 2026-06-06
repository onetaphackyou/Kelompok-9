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

    public function requestUpdate(Request $request, $id_jadwal)
    {
        $request->validate([
            'hari_request' => 'required',
            'jam_mulai_request' => 'required',
            'jam_selesai_request' => 'required',
            'ruangan_request' => 'required',
            'keterangan_request' => 'nullable',
        ]);

        $jadwal = Jadwal::findOrFail($id_jadwal);
        $id_dosen = Auth::user()->dosen->id_dosen;

        $jadwal->update([
            'hari_request' => $request->hari_request,
            'jam_mulai_request' => $request->jam_mulai_request,
            'jam_selesai_request' => $request->jam_selesai_request,
            'ruangan_request' => $request->ruangan_request,
            'keterangan_request' => $request->keterangan_request,
            'status_request' => 'pending',
            'id_dosen_request' => $id_dosen,
        ]);

        return redirect()->route('dosen.jadwal')->with('success', 'Request perubahan jadwal berhasil dikirim, menunggu persetujuan Admin Prodi!');
    }
}