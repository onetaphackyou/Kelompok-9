<?php
namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Penilaian;
use App\Models\PesertaKelasPerkuliahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'id_tugas' => 'required|exists:tugas_perkuliahan,id_tugas',
            'id_kelas' => 'required|exists:kelas_perkuliahan,id_kelas',
            'upload_file' => 'required|file|max:2048'
        ]);

        $id_mhs = Auth::user()->mahasiswa->id_mhs;

        // Cek atau buat peserta
        $peserta = PesertaKelasPerkuliahan::firstOrCreate([
            'id_kelas' => $request->id_kelas,
            'id_mhs' => $id_mhs
        ]);

        $file = $request->file('upload_file')->store('tugas_mahasiswa', 'public');

        Penilaian::updateOrCreate(
            ['id_tugas' => $request->id_tugas, 'id_mhs' => $id_mhs],
            [
                'id_peserta' => $peserta->id_peserta,
                'upload_file' => $file,
                'status' => 'diserahkan'
            ]
        );

        // Hitung ulang nilai akhir (bisa panggil helper)
        $this->hitungNilaiAkhir($id_mhs, $request->id_kelas);

        return redirect()->route('mahasiswa.kelas.detail', $request->id_kelas)->with('success', 'Tugas berhasil dikumpulkan');
    }

    private function hitungNilaiAkhir($id_mhs, $id_kelas)
    {
        $total_tugas = TugasPerkuliahan::whereHas('materi', fn($q) => $q->where('id_kelas', $id_kelas))->count();
        $submitted = Penilaian::where('id_mhs', $id_mhs)
            ->whereHas('tugas.materi', fn($q) => $q->where('id_kelas', $id_kelas))
            ->where('status', 'diserahkan')
            ->count();

        $nilai_akhir = $total_tugas > 0 ? round(($submitted / $total_tugas) * 100, 2) : null;
        PesertaKelasPerkuliahan::where('id_kelas', $id_kelas)->where('id_mhs', $id_mhs)
            ->update(['nilai_akhir' => $nilai_akhir]);
    }
}
