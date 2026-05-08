// app/Http/Controllers/AdminProdi/MahasiswaController.php
<?php

namespace App\Http\Controllers\AdminProdi;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $admin_prodi = Auth::user()->prodi;
        $action = $request->get('action');
        $id_mhs = $request->get('id');

        $data = Mahasiswa::where('prodi', $admin_prodi)->orderBy('id_mhs', 'desc')->get();
        $edit = null;

        if ($action === 'edit' && $id_mhs) {
            $edit = Mahasiswa::where('id_mhs', $id_mhs)->where('prodi', $admin_prodi)->first();
        }

        return view('admin_prodi.mahasiswa', compact('data', 'edit', 'action', 'admin_prodi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'prodi' => 'required',
            'periode' => 'required'
        ]);

        // Insert into users table
        $user = User::create([
            'nama' => $request->nim,
            'password' => Hash::make('mhs123'),
            'role' => 'mahasiswa',
            'status' => 'aktif',
            'prodi' => $request->prodi
        ]);

        // Insert into mahasiswa table
        Mahasiswa::create([
            'id_user' => $user->id_user,
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'prodi' => $request->prodi,
            'periode' => $request->periode
        ]);

        return redirect()->route('admin.mahasiswa')->with('msg', 'Mahasiswa berhasil ditambahkan!')->with('msg_type', 'success');
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim,' . $id . ',id_mhs',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'prodi' => 'required',
            'periode' => 'required'
        ]);

        $mahasiswa->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'prodi' => $request->prodi,
            'periode' => $request->periode
        ]);

        // Update user if needed
        if ($mahasiswa->user) {
            $mahasiswa->user->update(['nama' => $request->nim, 'prodi' => $request->prodi]);
        }

        return redirect()->route('admin.mahasiswa')->with('msg', 'Mahasiswa berhasil diperbarui!')->with('msg_type', 'success');
    }

    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $user = User::find($mahasiswa->id_user);

        $mahasiswa->delete();
        if ($user) $user->delete();

        return redirect()->route('admin.mahasiswa')->with('msg', 'Mahasiswa berhasil dihapus!')->with('msg_type', 'success');
    }
}
