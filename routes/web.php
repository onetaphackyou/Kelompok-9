<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// ==============================================
// GUEST ROUTES (Login, Register)
// ==============================================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// ==============================================
// HOME (redirect berdasarkan role)
// ==============================================
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        $role = $user->role;
        return match ($role) {
            'mahasiswa'    => redirect()->route('mahasiswa.dashboard'),
            'dosen'        => redirect()->route('dosen.dashboard'),
            'admin_prodi'  => redirect()->route('admin_prodi.dashboard'),
            'administrator'=> redirect()->route('administrator.dashboard'),
            default        => redirect()->route('login'),
        };
    }
    return redirect()->route('login');
})->name('home');

// ==============================================
// ADMINISTRATOR (role: administrator)
// ==============================================
Route::middleware(['auth', 'role:administrator'])
    ->prefix('administrator')
    ->name('administrator.')
    ->group(function () {
        // Pastikan controller Administrator\DashboardController sudah dibuat
        Route::get('/dashboard', [\App\Http\Controllers\Administrator\DashboardController::class, 'index'])->name('dashboard');

        // Profil administrator
        Route::get('/profile', [\App\Http\Controllers\Administrator\ProfileController::class, 'index'])->name('profile');
        Route::put('/profile', [\App\Http\Controllers\Administrator\ProfileController::class, 'update']);

        // Data master
        Route::get('/user', [\App\Http\Controllers\Administrator\UserController::class, 'index'])->name('user.index');
        Route::get('/user/create', [\App\Http\Controllers\Administrator\UserController::class, 'create'])->name('user.create');
        Route::post('/user', [\App\Http\Controllers\Administrator\UserController::class, 'store'])->name('user.store');
        Route::get('/user/{id}/edit', [\App\Http\Controllers\Administrator\UserController::class, 'edit'])->name('user.edit');
        Route::put('/user/{id}', [\App\Http\Controllers\Administrator\UserController::class, 'update'])->name('user.update');
        Route::delete('/user/{id}', [\App\Http\Controllers\Administrator\UserController::class, 'destroy'])->name('user.destroy');

        Route::get('/mahasiswa', [\App\Http\Controllers\Administrator\MahasiswaController::class, 'index'])->name('mahasiswa.index');
        Route::get('/dosen', [\App\Http\Controllers\Administrator\DosenController::class, 'index'])->name('dosen.index');
        Route::get('/mata-kuliah', [\App\Http\Controllers\Administrator\MataKuliahController::class, 'index'])->name('mata_kuliah.index');
        Route::get('/kelas-perkuliahan', [\App\Http\Controllers\Administrator\KelasPerkuliahanController::class, 'index'])->name('kelas_perkuliahan.index');

        // Tambahkan route lain untuk administrator di sini
    });

// ==============================================
// ADMIN PRODI (role: admin_prodi)
// ==============================================
Route::middleware(['auth', 'role:admin_prodi'])
    ->prefix('admin-prodi')
    ->name('admin_prodi.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [\App\Http\Controllers\AdminProdi\DashboardController::class, 'index'])->name('dashboard');

        // Profile
        Route::get('/profile', [\App\Http\Controllers\AdminProdi\ProfileController::class, 'index'])->name('profile');
        Route::post('/profile', [\App\Http\Controllers\AdminProdi\ProfileController::class, 'update']);

        // Manajemen Mahasiswa
        Route::get('/mahasiswa', [\App\Http\Controllers\AdminProdi\MahasiswaController::class, 'index'])->name('mahasiswa');
        Route::post('/mahasiswa', [\App\Http\Controllers\AdminProdi\MahasiswaController::class, 'store']);
        Route::post('/mahasiswa/{id}', [\App\Http\Controllers\AdminProdi\MahasiswaController::class, 'update']);
        Route::delete('/mahasiswa/{id}', [\App\Http\Controllers\AdminProdi\MahasiswaController::class, 'destroy']);

        // Manajemen Dosen
        Route::get('/dosen', [\App\Http\Controllers\AdminProdi\DosenController::class, 'index'])->name('dosen');
        Route::post('/dosen', [\App\Http\Controllers\AdminProdi\DosenController::class, 'store']);
        Route::post('/dosen/{id}', [\App\Http\Controllers\AdminProdi\DosenController::class, 'update']);
        Route::delete('/dosen/{id}', [\App\Http\Controllers\AdminProdi\DosenController::class, 'destroy']);

        // Manajemen Mata Kuliah
        Route::get('/matkul', [\App\Http\Controllers\AdminProdi\MatkulController::class, 'index'])->name('matkul');
        Route::post('/matkul', [\App\Http\Controllers\AdminProdi\MatkulController::class, 'store']);
        Route::post('/matkul/{id}', [\App\Http\Controllers\AdminProdi\MatkulController::class, 'update']);
        Route::delete('/matkul/{id}', [\App\Http\Controllers\AdminProdi\MatkulController::class, 'destroy']);

        // Manajemen Kelas
        Route::get('/kelas', [\App\Http\Controllers\AdminProdi\KelasController::class, 'index'])->name('kelas');
        Route::post('/kelas', [\App\Http\Controllers\AdminProdi\KelasController::class, 'store']);
        Route::post('/kelas/{id}', [\App\Http\Controllers\AdminProdi\KelasController::class, 'update']);
        Route::delete('/kelas/{id}', [\App\Http\Controllers\AdminProdi\KelasController::class, 'destroy']);

        // Detail Kelas (peserta, materi, tugas)
        Route::get('/kelas/detail/{id_kelas}', [\App\Http\Controllers\AdminProdi\DetailKelasController::class, 'show'])->name('kelas.detail');

        // Peserta Kelas
        Route::get('/peserta', [\App\Http\Controllers\AdminProdi\PesertaController::class, 'index'])->name('peserta');
        Route::post('/peserta', [\App\Http\Controllers\AdminProdi\PesertaController::class, 'store']);
        Route::delete('/peserta/{id_peserta}', [\App\Http\Controllers\AdminProdi\PesertaController::class, 'destroy']);

        // Materi (tampilan global)
        Route::get('/materi', [\App\Http\Controllers\AdminProdi\MateriController::class, 'index'])->name('materi');

        // Tugas (tampilan global)
        Route::get('/tugas', [\App\Http\Controllers\AdminProdi\TugasController::class, 'index'])->name('tugas');
    });

// ==============================================
// DOSEN (role: dosen)
// ==============================================
Route::middleware(['auth', 'role:dosen'])
    ->prefix('dosen')
    ->name('dosen.')
    ->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Dosen\DashboardController::class, 'index'])->name('dashboard');

        // Kelas yang diampu
        Route::get('/kelas', [\App\Http\Controllers\Dosen\KelasController::class, 'index'])->name('kelas');
        Route::get('/kelas/{id_kelas}', [\App\Http\Controllers\Dosen\DetailKelasController::class, 'show'])->name('kelas.detail');

        // Materi (CRUD)
        Route::get('/materi/create/{id_kelas}', [\App\Http\Controllers\Dosen\TugasController::class, 'createMateri'])->name('materi.create');
        Route::post('/materi', [\App\Http\Controllers\Dosen\TugasController::class, 'storeMateri'])->name('materi.store');
        Route::get('/materi/{id_materi}/edit', [\App\Http\Controllers\Dosen\TugasController::class, 'editMateri'])->name('materi.edit');
        Route::put('/materi/{id_materi}', [\App\Http\Controllers\Dosen\TugasController::class, 'updateMateri'])->name('materi.update');
        Route::delete('/materi/{id_materi}', [\App\Http\Controllers\Dosen\TugasController::class, 'destroyMateri'])->name('materi.destroy');
        Route::post('/materi/tambah', [\App\Http\Controllers\Dosen\DetailKelasController::class, 'tambahMateri'])->name('materi.tambah');
        Route::delete('/materi/hapus/{id_materi}', [\App\Http\Controllers\Dosen\DetailKelasController::class, 'hapusMateri'])->name('materi.hapus');

        // Tugas (CRUD)
        Route::get('/tugas/create/{id_kelas}', [\App\Http\Controllers\Dosen\TugasController::class, 'createTugas'])->name('tugas.create');
        Route::post('/tugas', [\App\Http\Controllers\Dosen\TugasController::class, 'storeTugas'])->name('tugas.store');
        Route::get('/tugas/{id_tugas}/edit', [\App\Http\Controllers\Dosen\TugasController::class, 'editTugas'])->name('tugas.edit');
        Route::put('/tugas/{id_tugas}', [\App\Http\Controllers\Dosen\TugasController::class, 'updateTugas'])->name('tugas.update');
        Route::delete('/tugas/{id_tugas}', [\App\Http\Controllers\Dosen\TugasController::class, 'destroyTugas'])->name('tugas.destroy');
        Route::delete('/tugas/hapus/{id_tugas}', [\App\Http\Controllers\Dosen\DetailKelasController::class, 'hapusTugas'])->name('tugas.hapus');

        // Lihat pengumpulan tugas mahasiswa
        Route::get('/pengumpulan/{id_tugas}/kelas/{id_kelas}', [\App\Http\Controllers\Dosen\DetailKelasController::class, 'pengumpulan'])->name('pengumpulan');

        // Penilaian tugas
        Route::get('/beri-nilai/{id_penilaian}', [\App\Http\Controllers\Dosen\NilaiController::class, 'create'])->name('nilai.create');
        Route::post('/nilai', [\App\Http\Controllers\Dosen\NilaiController::class, 'store'])->name('nilai.store');

        // Nilai akhir mahasiswa
        Route::get('/nilai-akhir/{id_kelas}/{id_mhs}', [\App\Http\Controllers\Dosen\NilaiController::class, 'finalGradeForm'])->name('nilai.final.form');
        Route::post('/nilai-akhir/{id_kelas}/{id_mhs}', [\App\Http\Controllers\Dosen\NilaiController::class, 'finalGradeStore'])->name('nilai.final.store');

        // Profile dosen
        Route::get('/profile', [\App\Http\Controllers\Dosen\ProfileController::class, 'edit'])->name('profile');
        Route::put('/profile', [\App\Http\Controllers\Dosen\ProfileController::class, 'update'])->name('profile.update');
    });

// ==============================================
// MAHASISWA (role: mahasiswa)
// ==============================================
Route::middleware(['auth', 'role:mahasiswa'])
    ->prefix('mahasiswa')
    ->name('mahasiswa.')
    ->group(function () {
        Route::get('/complete-profile', [\App\Http\Controllers\Mahasiswa\ProfileController::class, 'completeProfile'])->name('complete_profile');
        Route::post('/complete-profile', [\App\Http\Controllers\Mahasiswa\ProfileController::class, 'storeCompleteProfile']);

        Route::get('/dashboard', [\App\Http\Controllers\Mahasiswa\DashboardController::class, 'index'])->name('dashboard');

        // Kelas yang diikuti
        Route::get('/kelas', [\App\Http\Controllers\Mahasiswa\KelasController::class, 'index'])->name('kelas');
        Route::get('/kelas/{id_kelas}', [\App\Http\Controllers\Mahasiswa\DetailKelasController::class, 'show'])->name('kelas.detail');

        // Submit tugas
        Route::post('/tugas/submit', [\App\Http\Controllers\Mahasiswa\TugasController::class, 'submit'])->name('tugas.submit');

        // Profile mahasiswa
        Route::get('/profile', [\App\Http\Controllers\Mahasiswa\ProfileController::class, 'edit'])->name('profile');
        Route::put('/profile', [\App\Http\Controllers\Mahasiswa\ProfileController::class, 'update'])->name('profile.update');
    });


