// app/Http/Controllers/AdminProdi/PesertaController.php
<?php

namespace App\Http\Controllers\AdminProdi;

use App\Http\Controllers\Controller;
use App\Models\KelasPerkuliahan;
use App\Models\PesertaKelasPerkuliahan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesertaController extends Controller
{
    public function index(Request $request)
    {
        $admin_prodi = Auth::user()->prodi;
        $id_kelas = $request->get('id_kelas', 0);

        // Get all kelas for this prodi
        $kelas = KelasPerkuliahan::with(['mataKuliah', 'dosen'])
            ->whereHas('dosen', function($q) use ($admin_prodi) {
                $q->where('prodi', $admin_prodi);
            })
            ->orderBy('nama_kelas')
            ->get();

        $info_kelas = null;
        $peserta = [];
        $mhs_available = [];

        if ($id_kelas) {
            $info_kelas = KelasPerkuliahan::with(['mataKuliah', 'dosen'])
                ->where('id_kelas', $id_kelas)
                ->whereHas('dosen', function($q) use ($admin_prodi) {
                    $q->where('prodi', $admin_prodi);
                })
                ->first();

            if ($info_kelas) {
                $peserta = PesertaKelasPerkuliahan::with('mahasiswa')
                    ->where('id_kelas', $id_kelas)
                    ->get();

                $peserta_ids = $peserta->pluck('id_mhs')->toArray();

                $mhs_available = Mahasiswa::where('prodi', $admin_prodi)
                    ->whereNotIn('id_mhs', $peserta_ids)
                    ->orderBy('nama')
                    ->get();
            }
        }

        return view('admin_prodi.peserta', compact('kelas', 'info_kelas', 'peserta', 'mhs_available', 'id_kelas', 'admin_prodi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required',
            'id_mhs' => 'required'
        ]);

        $exists = PesertaKelasPerkuliahan::where('id_kelas', $request->id_kelas)
            ->where('id_mhs', $request->id_mhs)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('msg', 'Mahasiswa sudah terdaftar!')->with('msg_type', 'warning');
        }

        PesertaKelasPerkuliahan::create([
            'id_kelas' => $request->id_kelas,
            'id_mhs' => $request->id_mhs
        ]);

        return redirect()->back()->with('msg', 'Peserta berhasil ditambahkan!')->with('msg_type', 'success');
    }

    public function destroy($id_peserta, Request $request)
    {
        $peserta = PesertaKelasPerkuliahan::findOrFail($id_peserta);
        $id_kelas = $request->query('id_kelas');
        $peserta->delete();

        return redirect()->route('admin.peserta', ['id_kelas' => $id_kelas])->with('msg', 'Peserta berhasil dihapus!')->with('msg_type', 'success');
    }
}
