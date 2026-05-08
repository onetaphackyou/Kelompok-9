<?php
namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id_user', 'desc')->get();
        return view('administrator.user', compact('users'));
    }

    public function create()
    {
        return view('administrator.user_form', ['action' => 'add']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,nama',
            'password' => 'required|min:4',
            'role'     => 'required|in:mahasiswa,dosen,admin_prodi,administrator',
            'status'   => 'required|in:aktif,nonaktif',
            'prodi'    => 'required_if:role,admin_prodi'
        ]);

        User::create([
            'nama'     => $request->username,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
            'status'   => $request->status,
            'prodi'    => $request->role == 'admin_prodi' ? $request->prodi : null,
        ]);

        return redirect()->route('administrator.user.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('administrator.user_form', ['action' => 'edit', 'user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|unique:users,nama,' . $id . ',id_user',
            'role'     => 'required|in:mahasiswa,dosen,admin_prodi,administrator',
            'status'   => 'required|in:aktif,nonaktif',
            'prodi'    => 'required_if:role,admin_prodi'
        ]);

        $data = [
            'nama'   => $request->username,
            'role'   => $request->role,
            'status' => $request->status,
            'prodi'  => $request->role == 'admin_prodi' ? $request->prodi : null,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->route('administrator.user.index')->with('success', 'User berhasil diperbarui');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('administrator.user.index')->with('success', 'User berhasil dihapus');
    }
}
