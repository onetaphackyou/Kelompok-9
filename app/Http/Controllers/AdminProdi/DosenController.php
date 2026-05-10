<?php

namespace App\Http\Controllers\AdminProdi;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $admin_prodi = Auth::user()->prodi;
        $action = $request->get('action');
        $id_dosen = $request->get('id');

        $data = Dosen::where('prodi', $admin_prodi)->orderBy('id_dosen', 'desc')->get();
        $edit = null;

        if ($action === 'edit' && $id_dosen) {
            $edit = Dosen::where('id_dosen', $id_dosen)->where('prodi', $admin_prodi)->first();
        }

        return view('admin_prodi.dosen', compact('data', 'edit', 'action', 'admin_prodi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:dosen',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'prodi' => 'required',
        ]);

        $user = User::create([
            'nama' => $request->nip,
            'password' => Hash::make('dosen123'),
            'role' => 'dosen',
            'status' => 'aktif',
            'prodi' => $request->prodi,
        ]);

        Dosen::create([
            'id_user' => $user->id_user,
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'jenis_jabatan' => $request->jenis_jabatan,
            'prodi' => $request->prodi,
        ]);

        return redirect()->route('admin_prodi.dosen')
            ->with('msg', 'Dosen berhasil ditambahkan!')
            ->with('msg_type', 'success');
    }

    public function update(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);

        $request->validate([
            'nip' => 'required|unique:dosen,nip,' . $id . ',id_dosen',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'prodi' => 'required',
        ]);

        $dosen->update([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'jenis_jabatan' => $request->jenis_jabatan,
            'prodi' => $request->prodi,
        ]);

        if ($dosen->user) {
            $dosen->user->update(['nama' => $request->nip, 'prodi' => $request->prodi]);
        }

        return redirect()->route('admin_prodi.dosen')
            ->with('msg', 'Dosen berhasil diperbarui!')
            ->with('msg_type', 'success');
    }

    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        $user = User::find($dosen->id_user);

        $dosen->delete();
        if ($user) {
            $user->delete();
        }

        return redirect()->route('admin_prodi.dosen')
            ->with('msg', 'Dosen berhasil dihapus!')
            ->with('msg_type', 'success');
    }
}

