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
// ROUTE DOWNLOAD FILE (auth required)
// ==============================================
Route::get('/download/{filename}', function ($filename) {
    $path = public_path('uploads/' . $filename);
    if (!file_exists($path)) {
        abort(404, 'File tidak ditemukan');
    }
    return response()->download($path);
})->middleware('auth')->name('download.file');

Route::get('/download-tugas/{filename}', function ($filename) {
    $path = storage_path('app/public/tugas_mahasiswa/' . $filename);
    if (!file_exists($path)) {
        abort(404, 'File tidak ditemukan');
    }
    return response()->download($path);
})->middleware('auth')->name('download.tugas');

// ==============================================
// HOME
// ==============================================
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        $role = $user->role;
        return match ($role) {
            'mahasiswa'     => redirect()->route('mahasiswa.dashboard'),
            'dosen'         => redirect()->route('dosen.dashboard'),
            'admin_prodi'   => redirect()->route('admin_prodi.dashboard'),
            'administrator' => redirect()->route('administrator.dashboard'),
            default         => redirect()->route('login'),
        };
    }
    return redirect()->route('login');
})->name('home');

// ==============================================
// ADMINISTRATOR
// ==============================================
Route::middleware(['auth', 'role:administrator'])
    ->prefix('administrator')
    ->name('administrator.')
    ->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Administrator\DashboardController::class, 'index'])->name('dashboard');

        Route::get('/profile', [\App\Http\Controllers\Administrator\ProfileController::class, 'index'])->name('profile');
        Route::put('/profile', [\App\Http\Controllers\Administrator\ProfileController::class, 'update']);

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
    });

// ==============================================
// ADMIN PRODI
// ==============================================
Route::middleware(['auth', 'role:admin_prodi'])
    ->prefix('admin-prodi')
    ->name('admin_prodi.')
    ->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\AdminProdi\DashboardController::class, 'index'])->name('dashboard');

        Route::get('/profile', [\App\Http\Controllers\AdminProdi\ProfileController::class, 'index'])->name('profile');
        Route::post('/profile', [\App\Http\Controllers\AdminProdi\ProfileController::class, 'update']);

        Route::get('/mahasiswa', [\App\Http\Controllers\AdminProdi\MahasiswaController::class, 'index'])->name('mahasiswa');
        Route::post('/mahasiswa', [\App\Http\Controllers\AdminProdi\MahasiswaController::class, 'store'])->name('mahasiswa.store');
        Route::post('/mahasiswa/{id}', [\App\Http\Controllers\AdminProdi\MahasiswaController::class, 'update'])->name('mahasiswa.update');
        Route::delete('/mahasiswa/{id}', [\App\Http\Controllers\AdminProdi\MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

        Route::get('/dosen', [\App\Http\Controllers\AdminProdi\DosenController::class, 'index'])->name('dosen');
        Route::post('/dosen', [\App\Http\Controllers\AdminProdi\DosenController::class, 'store'])->name('dosen.store');
        Route::post('/dosen/{id}', [\App\Http\Controllers\AdminProdi\DosenController::class, 'update'])->name('dosen.update');
        Route::delete('/dosen/{id}', [\App\Http\Controllers\AdminProdi\DosenController::class, 'destroy'])->name('dosen.destroy');

        Route::get('/matkul', [\App\Http\Controllers\AdminProdi\MatkulController::class, 'index'])->name('matkul');
        Route::post('/matkul', [\App\Http\Controllers\AdminProdi\MatkulController::class, 'store'])->name('matkul.store');
        Route::post('/matkul/{id}', [\App\Http\Controllers\AdminProdi\MatkulController::class, 'update'])->name('matkul.update');
        Route::delete('/matkul/{id}', [\App\Http\Controllers\AdminProdi\MatkulController::class, 'destroy'])->name('matkul.destroy');

        Route::get('/kelas', [\App\Http\Controllers\AdminProdi\KelasController::class, 'index'])->name('kelas');
        Route::post('/kelas', [\App\Http\Controllers\AdminProdi\KelasController::class, 'store'])->name('kelas.store');
        Route::post('/kelas/{id}', [\App\Http\Controllers\AdminProdi\KelasController::class, 'update'])->name('kelas.update');
        Route::delete('/kelas/{id}', [\App\Http\Controllers\AdminProdi\KelasController::class, 'destroy'])->name('kelas.destroy');

        Route::get('/kelas/detail/{id_kelas}', [\App\Http\Controllers\AdminProdi\DetailKelasController::class, 'show'])->name('kelas.detail');

        Route::get('/peserta', [\App\Http\Controllers\AdminProdi\PesertaController::class, 'index'])->name('peserta');
        Route::post('/peserta', [\App\Http\Controllers\AdminProdi\PesertaController::class, 'store'])->name('peserta.store');
        Route::delete('/peserta/{id_peserta}', [\App\Http\Controllers\AdminProdi\PesertaController::class, 'destroy'])->name('peserta.destroy');

        Route::get('/materi', [\App\Http\Controllers\AdminProdi\MateriController::class, 'index'])->name('materi');
        Route::get('/tugas', [\App\Http\Controllers\AdminProdi\TugasController::class, 'index'])->name('tugas');

        // Jadwal
        Route::get('/jadwal', [\App\Http\Controllers\AdminProdi\JadwalController::class, 'index'])->name('jadwal');
        Route::post('/jadwal', [\App\Http\Controllers\AdminProdi\JadwalController::class, 'store'])->name('jadwal.store');
        Route::delete('/jadwal/{id_jadwal}', [\App\Http\Controllers\AdminProdi\JadwalController::class, 'destroy'])->name('jadwal.hapus');
    
        Route::post('/jadwal/{id_jadwal}/approve', [\App\Http\Controllers\AdminProdi\JadwalController::class, 'approve'])->name('jadwal.approve');
        Route::post('/jadwal/{id_jadwal}/reject', [\App\Http\Controllers\AdminProdi\JadwalController::class, 'reject'])->name('jadwal.reject');
    });

// ==============================================
// DOSEN
// ==============================================
Route::middleware(['auth', 'role:dosen'])
    ->prefix('dosen')
    ->name('dosen.')
    ->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Dosen\DashboardController::class, 'index'])->name('dashboard');

        Route::get('/kelas', [\App\Http\Controllers\Dosen\KelasController::class, 'index'])->name('kelas');
        Route::get('/kelas/{id_kelas}', [\App\Http\Controllers\Dosen\DetailKelasController::class, 'show'])->name('kelas.detail');

        Route::get('/materi/create/{id_kelas}', [\App\Http\Controllers\Dosen\TugasController::class, 'createMateri'])->name('materi.create');
        Route::post('/materi', [\App\Http\Controllers\Dosen\TugasController::class, 'storeMateri'])->name('materi.store');
        Route::get('/materi/{id_materi}/edit', [\App\Http\Controllers\Dosen\TugasController::class, 'editMateri'])->name('materi.edit');
        Route::put('/materi/{id_materi}', [\App\Http\Controllers\Dosen\TugasController::class, 'updateMateri'])->name('materi.update');
        Route::delete('/materi/{id_materi}', [\App\Http\Controllers\Dosen\TugasController::class, 'destroyMateri'])->name('materi.destroy');
        Route::post('/materi/tambah', [\App\Http\Controllers\Dosen\DetailKelasController::class, 'tambahMateri'])->name('materi.tambah');
        Route::delete('/materi/hapus/{id_materi}', [\App\Http\Controllers\Dosen\DetailKelasController::class, 'hapusMateri'])->name('materi.hapus');

        Route::get('/tugas/create/{id_kelas}', [\App\Http\Controllers\Dosen\TugasController::class, 'createTugas'])->name('tugas.create');
        Route::post('/tugas', [\App\Http\Controllers\Dosen\TugasController::class, 'storeTugas'])->name('tugas.store');
        Route::get('/tugas/{id_tugas}/edit', [\App\Http\Controllers\Dosen\TugasController::class, 'editTugas'])->name('tugas.edit');
        Route::put('/tugas/{id_tugas}', [\App\Http\Controllers\Dosen\TugasController::class, 'updateTugas'])->name('tugas.update');
        Route::delete('/tugas/{id_tugas}', [\App\Http\Controllers\Dosen\TugasController::class, 'destroyTugas'])->name('tugas.destroy');
        Route::delete('/tugas/hapus/{id_tugas}', [\App\Http\Controllers\Dosen\DetailKelasController::class, 'hapusTugas'])->name('tugas.hapus');

        Route::get('/pengumpulan/{id_tugas}/kelas/{id_kelas}', [\App\Http\Controllers\Dosen\DetailKelasController::class, 'pengumpulan'])->name('pengumpulan');

        Route::get('/beri-nilai/{id_penilaian}', [\App\Http\Controllers\Dosen\NilaiController::class, 'create'])->name('nilai.create');
        Route::post('/nilai', [\App\Http\Controllers\Dosen\NilaiController::class, 'store'])->name('nilai.store');

        Route::get('/nilai-akhir/{id_kelas}/{id_mhs}', [\App\Http\Controllers\Dosen\NilaiController::class, 'finalGradeForm'])->name('nilai.final.form');
        Route::post('/nilai-akhir/{id_kelas}/{id_mhs}', [\App\Http\Controllers\Dosen\NilaiController::class, 'finalGradeStore'])->name('nilai.final.store');

        Route::get('/profile', [\App\Http\Controllers\Dosen\ProfileController::class, 'edit'])->name('profile');
        Route::put('/profile', [\App\Http\Controllers\Dosen\ProfileController::class, 'update'])->name('profile.update');

        // Pengumuman
        Route::get('/pengumuman/{id_kelas}', [\App\Http\Controllers\Dosen\PengumumanController::class, 'index'])->name('pengumuman');
        Route::post('/pengumuman', [\App\Http\Controllers\Dosen\PengumumanController::class, 'store'])->name('pengumuman.store');
        Route::delete('/pengumuman/{id_pengumuman}', [\App\Http\Controllers\Dosen\PengumumanController::class, 'destroy'])->name('pengumuman.hapus');
        Route::get('/pengumuman-all', [\App\Http\Controllers\Dosen\PengumumanAllController::class, 'index'])->name('pengumuman.index');

        // Materi & Tugas Page
        Route::get('/materi-page', [\App\Http\Controllers\Dosen\MateriPageController::class, 'index'])->name('materi.page');
        Route::get('/tugas-page', [\App\Http\Controllers\Dosen\TugasPageController::class, 'index'])->name('tugas.page');

        // Materi & Tugas Page
        Route::get('/materi-page', [\App\Http\Controllers\Dosen\MateriPageController::class, 'index'])->name('materi.page');
        Route::get('/tugas-page', [\App\Http\Controllers\Dosen\TugasPageController::class, 'index'])->name('tugas.page');

        // Jadwal Dosen (lihat & edit)
        Route::get('/jadwal', [\App\Http\Controllers\Dosen\JadwalController::class, 'index'])->name('jadwal');
        Route::post('/jadwal/{id_jadwal}/request', [\App\Http\Controllers\Dosen\JadwalController::class, 'requestUpdate'])->name('jadwal.request');

        Route::get('/pengumuman-all', [\App\Http\Controllers\Dosen\PengumumanAllController::class, 'index'])->name('pengumuman.index');
        Route::post('/pengumuman-all', [\App\Http\Controllers\Dosen\PengumumanAllController::class, 'store'])->name('pengumuman.index.store');
        Route::delete('/pengumuman-all/{id_pengumuman}', [\App\Http\Controllers\Dosen\PengumumanAllController::class, 'destroy'])->name('pengumuman.index.hapus');
    });

// ==============================================
// MAHASISWA
// ==============================================
Route::middleware(['auth', 'role:mahasiswa'])
    ->prefix('mahasiswa')
    ->name('mahasiswa.')
    ->group(function () {
        Route::get('/complete-profile', [\App\Http\Controllers\Mahasiswa\ProfileController::class, 'completeProfile'])->name('complete_profile');
        Route::post('/complete-profile', [\App\Http\Controllers\Mahasiswa\ProfileController::class, 'storeCompleteProfile']);

        Route::get('/dashboard', [\App\Http\Controllers\Mahasiswa\DashboardController::class, 'index'])->name('dashboard');

        Route::get('/kelas', [\App\Http\Controllers\Mahasiswa\KelasController::class, 'index'])->name('kelas');
        Route::get('/kelas/{id_kelas}', [\App\Http\Controllers\Mahasiswa\DetailKelasController::class, 'show'])->name('kelas.detail');

        Route::post('/tugas/submit', [\App\Http\Controllers\Mahasiswa\TugasController::class, 'submit'])->name('tugas.submit');

        Route::get('/profile', [\App\Http\Controllers\Mahasiswa\ProfileController::class, 'edit'])->name('profile');
        Route::put('/profile', [\App\Http\Controllers\Mahasiswa\ProfileController::class, 'update'])->name('profile.update');

        // Pengumuman (lihat saja)
        Route::get('/pengumuman/{id_kelas}', [\App\Http\Controllers\Mahasiswa\PengumumanController::class, 'index'])->name('pengumuman');

        // Materi, Tugas, Nilai Page
        Route::get('/materi', [\App\Http\Controllers\Mahasiswa\MateriController::class, 'index'])->name('materi');
        Route::get('/tugas', [\App\Http\Controllers\Mahasiswa\TugasPageController::class, 'index'])->name('tugas');
        Route::get('/nilai', [\App\Http\Controllers\Mahasiswa\NilaiController::class, 'index'])->name('nilai');

        // Materi, Tugas, Nilai, Jadwal Page
        Route::get('/materi', [\App\Http\Controllers\Mahasiswa\MateriController::class, 'index'])->name('materi');
        Route::get('/tugas', [\App\Http\Controllers\Mahasiswa\TugasPageController::class, 'index'])->name('tugas');
        Route::get('/nilai', [\App\Http\Controllers\Mahasiswa\NilaiController::class, 'index'])->name('nilai');
        Route::get('/jadwal', [\App\Http\Controllers\Mahasiswa\JadwalController::class, 'index'])->name('jadwal');
        Route::get('/pengumuman', [\App\Http\Controllers\Mahasiswa\PengumumanAllController::class, 'index'])->name('pengumuman.all');

    });