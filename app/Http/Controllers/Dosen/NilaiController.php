<?php
namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Penilaian;
use App\Models\PesertaKelasPerkuliahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    // ... method create() dan store() untuk memberi nilai per tugas (sudah ada)

    /**
     * Tampilkan form beri nilai akhir untuk seorang mahasiswa di kelas tertentu
     */
    public function finalGradeForm($id_kelas, $id_mhs)
    {
        $id_dosen = Auth::user()->dosen->id_dosen;

        // Verifikasi kepemilikan kelas oleh dosen
        $kelas = \App\Models\KelasPerkuliahan::where('id_kelas', $id_kelas)
                    ->where('id_dosen', $id_dosen)
                    ->firstOrFail();

        $mahasiswa = \App\Models\Mahasiswa::findOrFail($id_mhs);
        $peserta = PesertaKelasPerkuliahan::where('id_kelas', $id_kelas)
                    ->where('id_mhs', $id_mhs)
                    ->firstOrFail();

        return view('dosen.beri_nilai_akhir', compact('kelas', 'mahasiswa', 'peserta'));
    }

    /**
     * Simpan nilai akhir (manual) untuk seorang mahasiswa
     */
    public function finalGradeStore(Request $request, $id_kelas, $id_mhs)
    {
        $request->validate([
            'nilai_akhir' => 'required|string|max:10'
        ]);

        $id_dosen = Auth::user()->dosen->id_dosen;

        $kelas = \App\Models\KelasPerkuliahan::where('id_kelas', $id_kelas)
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
