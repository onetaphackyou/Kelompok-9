<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\TugasPerkuliahan;
use App\Models\MateriPerkuliahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    public function createMateri($id_kelas)
    {
        // Untuk konsistensi route, metode ini disediakan.
        return redirect()->route('dosen.kelas.detail', $id_kelas);
    }

    public function storeMateri(Request $request)
    {
        return redirect()->back();
    }

    public function editMateri($id_materi)
    {
        $materi = MateriPerkuliahan::findOrFail($id_materi);
        return view('dosen.form_materi', ['materi' => $materi, 'action' => 'edit']);
    }

    public function updateMateri(Request $request, $id_materi)
    {
        $materi = MateriPerkuliahan::findOrFail($id_materi);
        $request->validate([
            'judul_materi' => 'required',
            'deskripsi' => 'nullable',
        ]);

        $materi->update([
            'judul_materi' => $request->judul_materi,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('dosen.kelas.detail', $materi->id_kelas);
    }

    public function destroyMateri($id_materi)
    {
        $materi = MateriPerkuliahan::findOrFail($id_materi);
        $id_kelas = $materi->id_kelas;
        $materi->delete();
        return redirect()->route('dosen.kelas.detail', $id_kelas);
    }

    public function createTugas($id_kelas)
    {
        return redirect()->route('dosen.kelas.detail', $id_kelas);
    }

   public function storeTugas(Request $request)
{
    $request->validate([
        'id_materi' => 'required',
        'judul_tugas' => 'required',
        'deskripsi_tugas' => 'nullable',
        'deadline' => 'required|date',
        'file_tugas' => 'nullable|file|max:5120',
    ]);

    $file_path = null;
    if ($request->hasFile('file_tugas')) {
        $file = $request->file('file_tugas');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $filename);
        $file_path = $filename;
    }

    $tugas = TugasPerkuliahan::create([
        'id_materi' => $request->id_materi,
        'judul_tugas' => $request->judul_tugas,
        'deskripsi_tugas' => $request->deskripsi_tugas,
        'deadline' => $request->deadline,
        'file_tugas' => $file_path,
    ]);

    $materi = MateriPerkuliahan::find($tugas->id_materi);
    return redirect()->route('dosen.kelas.detail', $materi?->id_kelas)->with('success', 'Tugas berhasil ditambahkan');
}

    public function editTugas($id_tugas)
    {
        $tugas = TugasPerkuliahan::with('materi')->findOrFail($id_tugas);
        return view('dosen.form_tugas', ['tugas' => $tugas, 'action' => 'edit']);
    }

    public function updateTugas(Request $request, $id_tugas)
    {
        $tugas = TugasPerkuliahan::findOrFail($id_tugas);

        $request->validate([
            'judul_tugas' => 'required',
            'deskripsi_tugas' => 'nullable',
            'deadline' => 'required|date',
        ]);

        $tugas->update([
            'judul_tugas' => $request->judul_tugas,
            'deskripsi_tugas' => $request->deskripsi_tugas,
            'deadline' => $request->deadline,
        ]);

        $materi = MateriPerkuliahan::find($tugas->id_materi);
        return redirect()->route('dosen.kelas.detail', $materi?->id_kelas);
    }

    public function destroyTugas($id_tugas)
    {
        $tugas = TugasPerkuliahan::with('materi')->findOrFail($id_tugas);
        $id_kelas = $tugas->materi?->id_kelas;
        $tugas->delete();
        return redirect()->route('dosen.kelas.detail', $id_kelas);
    }

    public function pengumpulan($id_tugas, $id_kelas)
    {
        // Delegasikan ke DetailKelasController (route sebenarnya sudah diarahkan ke DetailKelasController)
        // Method ini tetap ada agar controller kompatibel jika dipanggil.
        return redirect()->route('dosen.kelas.detail', $id_kelas);
    }
}

