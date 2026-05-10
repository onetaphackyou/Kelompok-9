<?php

namespace App\Http\Controllers\AdminProdi;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatkulController extends Controller
{
    public function index(Request $request)
    {
        $admin_prodi = Auth::user()->prodi;
        $action = $request->get('action');
        $id_matkul = $request->get('id');

        $matkul = MataKuliah::where('prodi', $admin_prodi)->orderBy('nama_matkul')->get();
        $edit_data = null;

        if ($action === 'edit' && $id_matkul) {
            $edit_data = MataKuliah::find($id_matkul);
        }

        return view('admin_prodi.matkul', compact('matkul', 'edit_data', 'action', 'admin_prodi'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nama_matkul' => 'required',
            'sks' => 'required|integer|min:1|max:6',
            'semester' => 'required|integer',
            'jenis_matkul' => 'required',
            'prodi' => 'required',
        ]);

        MataKuliah::create($request->all());

        return redirect()->route('admin_prodi.matkul')
            ->with('msg', 'Mata Kuliah berhasil ditambahkan!')
            ->with('msg_type', 'success');
    }

    public function update(Request $request, $id)
    {
        $matkul = MataKuliah::findOrFail($id);

        $request->validate([
            'nama_matkul' => 'required',
            'sks' => 'required|integer|min:1|max:6',
            'semester' => 'required|integer',
            'jenis_matkul' => 'required',
            'prodi' => 'required',
        ]);

        $matkul->update($request->all());

        return redirect()->route('admin_prodi.matkul')
            ->with('msg', 'Mata Kuliah berhasil diperbarui!')
            ->with('msg_type', 'success');
    }

    public function destroy($id)
    {
        $matkul = MataKuliah::findOrFail($id);
        $matkul->delete();

        return redirect()->route('admin_prodi.matkul')
            ->with('msg', 'Mata Kuliah berhasil dihapus!')
            ->with('msg_type', 'success');
    }
}

