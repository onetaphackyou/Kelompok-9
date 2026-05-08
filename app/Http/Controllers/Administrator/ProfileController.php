<?php
namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('administrator.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|unique:users,nama,' . $user->id_user . ',id_user',
            'password' => 'nullable|min:4'
        ]);

        $data = ['nama' => $request->username];
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        // Update session name
        session(['nama' => $request->username]);

        return redirect()->route('administrator.profile')->with('success', 'Profil berhasil diperbarui');
    }
}
