<?php
namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Penilaian;
use App\Models\PesertaKelasPerkuliahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function create($id_penilaian)
    {
        // $id_penilaian di sini adalah nilai id_nilai dari tabel penilaian
        $penilaian = Penilaian::with(['tugas.materi', 'mahasiswa'])->findOrFail($id_penilaian);
        return view('dosen.beri_nilai', compact('penilaian'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // FIX: sesuaikan nama field dengan yang dikirim form (id_nilai)
            'id_nilai' => 'required|exists:penilaian,id_nilai',
            'nilai'    => 'required|numeric|min:0|max:100',
        ]);

        // FIX: cari pakai id_nilai
        $penilaian = Penilaian::findOrFail($request->id_nilai);
        $penilaian->update(['nilai' => $request->nilai]);

        $id_kelas = $penilaian->tugas->materi->id_kelas;
        return redirect()->route('dosen.kelas.detail', $id_kelas)
                         ->with('success', 'Nilai berhasil disimpan');
    }

    public function finalGradeForm($id_kelas, $id_mhs)
    {
        $id_dosen = Auth::user()->dosen->id_dosen;

        $kelas = \App\Models\KelasPerkuliahan::where('id_kelas', $id_kelas)
                    ->where('id_dosen', $id_dosen)
                    ->firstOrFail();

        $mahasiswa = \App\Models\Mahasiswa::findOrFail($id_mhs);
        $peserta = PesertaKelasPerkuliahan::where('id_kelas', $id_kelas)
                    ->where('id_mhs', $id_mhs)
                    ->firstOrFail();

        return view('dosen.beri_nilai_akhir', compact('kelas', 'mahasiswa', 'peserta'));
    }

    public function finalGradeStore(Request $request, $id_kelas, $id_mhs)
    {
        $request->validate([
            'nilai_akhir' => 'required|string|max:10'
        ]);

        $id_dosen = Auth::user()->dosen->id_dosen;

        \App\Models\KelasPerkuliahan::where('id_kelas', $id_kelas)
            ->where('id_dosen', $id_dosen)
            ->firstOrFail();

        $peserta = PesertaKelasPerkuliahan::where('id_kelas', $id_kelas)
                    ->where('id_mhs', $id_mhs)
                    ->firstOrFail();

        $peserta->update(['nilai_akhir' => $request->nilai_akhir]);

        return redirect()->route('dosen.kelas.detail', $id_kelas)
                         ->with('success', 'Nilai akhir berhasil disimpan');
    }
}