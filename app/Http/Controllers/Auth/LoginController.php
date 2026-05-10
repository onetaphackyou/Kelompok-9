<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Normalisasi input supaya tahan spasi tersembunyi/format tidak konsisten
        $rawInput = (string) $request->username;
        $input = strtolower(trim($rawInput));

        // khusus email: buang semua whitespace (mis. "admin@x.com ")
        $emailInput = strtolower(trim($rawInput));
        $emailInput = preg_replace('/\s+/', '', $emailInput);

        // khusus nama: rapikan spasi ganda
        $namaInput = strtolower(trim($rawInput));
        $namaInput = preg_replace('/\s+/', ' ', $namaInput);

        // Cek email dulu
        $user = User::whereRaw('LOWER(email) = ?', [$emailInput])->first();
        // Jika tidak ketemu, cek nama
        if (!$user) {
            $user = User::whereRaw('LOWER(nama) = ?', [$namaInput])->first();
        }


        if ($user && Hash::check($request->password, $user->password)) {

            if ($user->status !== 'aktif') {
                return back()->with('error', 'Akun tidak aktif');
            }

            Auth::login($user);
            session([
                'login' => true,
                'user_id' => $user->id_user,
                'username' => $user->nama,
                'role' => $user->role,
            ]);
            $user->update(['last_login' => now()]);

            if ($user->role == 'mahasiswa') {
                $mahasiswa = Mahasiswa::where('id_user', $user->id_user)->first();
                if ($mahasiswa) {
                    session([
                        'id_mhs' => $mahasiswa->id_mhs,
                        'nama' => $mahasiswa->nama
                    ]);
                } else {
                    session(['nama' => $user->nama]);
                }
                return redirect()->route('mahasiswa.dashboard');
            } elseif ($user->role == 'dosen') {
                $dosen = Dosen::where('id_user', $user->id_user)->first();
                if ($dosen) {
                    session([
                        'id_dosen' => $dosen->id_dosen,
                        'nama' => $dosen->nama
                    ]);
                } else {
                    session(['nama' => $user->nama]);
                }
                return redirect()->route('dosen.dashboard');
            } elseif ($user->role == 'admin_prodi') {
                session([
                    'nama' => $user->nama,
                    'prodi' => $user->prodi ?? 'Teknik Informatika'
                ]);
                $dosen = Dosen::where('id_user', $user->id_user)->first();
                if ($dosen) {
                    session(['id_dosen' => $dosen->id_dosen]);
                }
                return redirect()->route('admin_prodi.dashboard');
            } elseif ($user->role == 'administrator') {
                session(['nama' => 'Administrator']);
                return redirect()->route('administrator.dashboard');
            } else {
                Auth::logout();
                return back()->with('error', 'Role tidak valid');
            }
        }

        return back()->with('error', 'Nama/email atau password salah');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
