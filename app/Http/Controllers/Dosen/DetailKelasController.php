<?php
namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\KelasPerkuliahan;
use App\Models\MateriPerkuliahan;
use App\Models\TugasPerkuliahan;
use App\Models\Penilaian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DetailKelasController extends Controller
{
    public function show($id_kelas)
    {
        $user = Auth::user();
        $dosen = $user->dosen;
        if (!$dosen) abort(403);

        $kelas_info = KelasPerkuliahan::with('mataKuliah')
            ->where('id_kelas', $id_kelas)
            ->where('id_dosen', $dosen->id_dosen)
            ->firstOrFail();

        $materi_list = MateriPerkuliahan::where('id_kelas', $id_kelas)
            ->orderByDesc('id_materi')
            ->get();

        $tugas_list = TugasPerkuliahan::with(['materi'])
            ->whereHas('materi', fn($q) => $q->where('id_kelas', $id_kelas))
            ->withCount(['penilaian as jumlah_pengumpulan' => fn($q) => $q->where('status', 'diserahkan')])
            ->orderByDesc('deadline')
            ->get();

        // Nilai akhir mahasiswa
        $nilai_akhir = \App\Models\PesertaKelasPerkuliahan::with('mahasiswa')
            ->where('id_kelas', $id_kelas)
            ->get()
            ->sortBy(fn($item) => $item->mahasiswa?->nim ?? '')
            ->values();

        return view('dosen.detail', compact('kelas_info', 'materi_list', 'tugas_list', 'nilai_akhir', 'id_kelas'));
    }

    public function tambahMateri(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required|exists:kelas_perkuliahan,id_kelas',
            'judul_materi' => 'required',
            'deskripsi' => 'nullable',
            'upload_file' => 'nullable|file|mimes:pdf,ppt,pptx,doc,docx|max:5120',
        ]);

        $data = $request->only(['id_kelas', 'judul_materi', 'deskripsi']);
        if ($request->hasFile('upload_file')) {
            $file = $request->file('upload_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['upload_file'] = $filename;
        }

        MateriPerkuliahan::create($data);
        return redirect()->route('dosen.kelas.detail', $request->id_kelas)->with('success', 'Materi berhasil ditambahkan');
    }

    public function editMateri($id_materi)
    {
        $materi = MateriPerkuliahan::with('kelas')->findOrFail($id_materi);
        $this->authorizeDosen($materi->kelas->id_dosen);
        return view('dosen.form_materi', ['materi' => $materi, 'action' => 'edit']);
    }

    public function updateMateri(Request $request, $id_materi)
    {
        $materi = MateriPerkuliahan::with('kelas')->findOrFail($id_materi);
        $this->authorizeDosen($materi->kelas->id_dosen);

        $request->validate([
            'judul_materi' => 'required',
            'deskripsi' => 'nullable',
            'upload_file' => 'nullable|file|mimes:pdf,ppt,pptx,doc,docx|max:5120',
        ]);

        $data = $request->only(['judul_materi', 'deskripsi']);
        if ($request->hasFile('upload_file')) {
            // hapus file lama jika ada
            if ($materi->upload_file && file_exists(public_path('uploads/'.$materi->upload_file))) {
                unlink(public_path('uploads/'.$materi->upload_file));
            }
            $filename = time() . '_' . $request->file('upload_file')->getClientOriginalName();
            $request->file('upload_file')->move(public_path('uploads'), $filename);
            $data['upload_file'] = $filename;
        }

        $materi->update($data);
        return redirect()->route('dosen.kelas.detail', $materi->kelas->id_kelas)->with('success', 'Materi diperbarui');
    }

    public function hapusMateri($id_materi)
    {
        $materi = MateriPerkuliahan::with('kelas')->findOrFail($id_materi);
        $this->authorizeDosen($materi->kelas->id_dosen);
        if ($materi->upload_file && file_exists(public_path('uploads/'.$materi->upload_file))) {
            unlink(public_path('uploads/'.$materi->upload_file));
        }
        $id_kelas = $materi->kelas->id_kelas;
        $materi->delete();
        return redirect()->route('dosen.kelas.detail', $id_kelas)->with('success', 'Materi dihapus');
    }

    public function tambahTugas(Request $request)
    {
        $request->validate([
            'id_materi' => 'required|exists:materi_perkuliahan,id_materi',
            'judul_tugas' => 'required',
            'deskripsi_tugas' => 'nullable',
            'deadline' => 'required|date',
            'file_tugas' => 'nullable|file|mimes:pdf,ppt,pptx,doc,docx|max:5120',
        ]);

        $data = $request->only(['id_materi', 'judul_tugas', 'deskripsi_tugas', 'deadline']);
        if ($request->hasFile('file_tugas')) {
            $filename = time() . '_' . $request->file('file_tugas')->getClientOriginalName();
            $request->file('file_tugas')->move(public_path('uploads'), $filename);
            $data['file_tugas'] = $filename;
        }

        TugasPerkuliahan::create($data);
        $materi = MateriPerkuliahan::find($request->id_materi);
        return redirect()->route('dosen.kelas.detail', $materi->id_kelas)->with('success', 'Tugas ditambahkan');
    }
    public function hapusTugas($id_tugas)
{
    $tugas = TugasPerkuliahan::with('materi.kelas')->findOrFail($id_tugas);
    $this->authorizeDosen($tugas->materi->kelas->id_dosen);
    if ($tugas->file_tugas && file_exists(public_path('uploads/'.$tugas->file_tugas))) {
        unlink(public_path('uploads/'.$tugas->file_tugas));
    }
    $id_kelas = $tugas->materi->id_kelas;
    $tugas->delete();
    return redirect()->route('dosen.kelas.detail', $id_kelas)->with('success', 'Tugas dihapus');
}
/**
 * Lihat daftar pengumpulan untuk suatu tugas
 */
public function pengumpulan($id_tugas, $id_kelas)
{
    $id_dosen = Auth::user()->dosen->id_dosen;

    $tugas = \App\Models\TugasPerkuliahan::whereHas('materi', function($q) use ($id_kelas) {
                $q->where('id_kelas', $id_kelas);
              })->findOrFail($id_tugas);

    // Verifikasi manual kepemilikan kelas
    $kelas = $tugas->materi->kelas;
    if ($kelas->id_dosen != $id_dosen) abort(403);

    $pengumpulan = \App\Models\PesertaKelasPerkuliahan::with('mahasiswa')
                    ->where('id_kelas', $id_kelas)
                    ->get()
                    ->map(function($peserta) use ($id_tugas) {
                        $penilaian = \App\Models\Penilaian::where('id_tugas', $id_tugas)
                                        ->where('id_mhs', $peserta->id_mhs)
                                        ->first();
                        $peserta->penilaian = $penilaian;
                        return $peserta;
                    });

    return view('dosen.pengumpulan', compact('tugas', 'kelas', 'pengumpulan'));
}

    private function authorizeDosen($id_dosen)
    {
        if (Auth::user()->dosen->id_dosen != $id_dosen) abort(403);
    }
}
