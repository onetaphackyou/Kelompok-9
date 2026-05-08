// app/Http/Controllers/AdminProdi/KelasController.php
<?php

namespace App\Http\Controllers\AdminProdi;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use App\Models\Dosen;
use App\Models\KelasPerkuliahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        $admin_prodi = Auth::user()->prodi;
        $action = $request->get('action');
        $id_kelas = $request->get('id');
        $id_kelas_param = $request->get('id_kelas');

        if ($id_kelas_param) {
            $id_kelas = $id_kelas_param;
        }

        // Get mata kuliah for current prodi
        $matkul = MataKuliah::where(function($q) use ($admin_prodi) {
            $q->where('prodi', $admin_prodi)->orWhereNull('prodi');
        })->orderBy('nama_matkul')->get();

        // Get dosen for current prodi
        $dosen = Dosen::where('prodi', $admin_prodi)->orderBy('nama')->get();

        // Get kelas list
        $kelas = KelasPerkuliahan::with(['mataKuliah', 'dosen'])
            ->whereHas('dosen', function($q) use ($admin_prodi) {
                $q->where('prodi', $admin_prodi);
            })
            ->orderBy('id_kelas', 'desc')
            ->get();

        $edit_data = null;
        if ($action === 'edit' && $id_kelas) {
            $edit_data = KelasPerkuliahan::find($id_kelas);
        }

        return view('admin_prodi.kelas', compact('kelas', 'matkul', 'dosen', 'edit_data', 'action', 'admin_prodi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_matkul' => 'required',
            'nama_kelas' => 'required',
            'id_dosen' => 'required',
            'hari' => 'required',
            'jam_awal' => 'required',
            'jam_akhir' => 'required',
            'ruangan' => 'required',
            'periode' => 'required'
        ]);

        KelasPerkuliahan::create($request->all());

        return redirect()->route('admin.kelas')->with('msg', 'Kelas berhasil ditambahkan!')->with('msg_type', 'success');
    }

    public function update(Request $request, $id)
    {
        $kelas = KelasPerkuliahan::findOrFail($id);

        $request->validate([
            'id_matkul' => 'required',
            'nama_kelas' => 'required',
            'id_dosen' => 'required',
            'hari' => 'required',
            'jam_awal' => 'required',
            'jam_akhir' => 'required',
            'ruangan' => 'required',
            'periode' => 'required'
        ]);

        $kelas->update($request->all());

        return redirect()->route('admin.kelas')->with('msg', 'Kelas berhasil diperbarui!')->with('msg_type', 'success');
    }

    public function destroy($id)
    {
        $kelas = KelasPerkuliahan::findOrFail($id);
        $kelas->delete();

        return redirect()->route('admin.kelas')->with('msg', 'Kelas berhasil dihapus!')->with('msg_type', 'success');
    }
}
