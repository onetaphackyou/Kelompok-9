// routes/web.php
<?php

use App\Http\Controllers\AuthController;
// use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminProdi\DashboardController;
use App\Http\Controllers\AdminProdi\MahasiswaController;
use App\Http\Controllers\AdminProdi\DosenController;
use App\Http\Controllers\AdminProdi\KelasController;
use App\Http\Controllers\AdminProdi\DetailKelasController;
use App\Http\Controllers\AdminProdi\PesertaController;
use App\Http\Controllers\AdminProdi\MateriController;
use App\Http\Controllers\AdminProdi\TugasController;
use App\Http\Controllers\AdminProdi\MatkulController;
use App\Http\Controllers\AdminProdi\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administrator\ProfileController as AdminProfile;

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        $role = $user->role;
        switch ($role) {
            case 'mahasiswa':
                return redirect()->route('mahasiswa.dashboard');
            case 'dosen':
                return redirect()->route('dosen.dashboard');
            case 'admin_prodi':
                return redirect()->route('admin_prodi.dashboard');
            case 'administrator':
                return redirect()->route('administrator.dashboard');
            default:
                return redirect()->route('login');
        }
    }
    return redirect()->route('login');
})->name('home');

// Di dalam group administrator
Route::get('/profile', [AdminProfile::class, 'edit'])->name('profile');
Route::put('/profile', [AdminProfile::class, 'update'])->name('profile.update');


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Pastikan tidak ada route AuthController lain

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth'])->group(function () {
Route::get('/', function() {
        return redirect()->route('admin.dashboard');
    });

    Route::middleware(['auth','role:administrator'])->prefix('administrator')->name('administrator.')->group(function () {
    Route::get('/dashboard', [AdminDash::class, 'index'])->name('dashboard');
    // ...
});

    // Dosen
Route::middleware(['auth','role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Dosen\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/kelas', [\App\Http\Controllers\Dosen\KelasController::class, 'index'])->name('kelas');
    Route::get('/kelas/detail/{id_kelas}', [\App\Http\Controllers\Dosen\DetailKelasController::class, 'show'])->name('kelas.detail');

    // Materi CRUD
    Route::post('/materi/tambah', [\App\Http\Controllers\Dosen\DetailKelasController::class, 'tambahMateri'])->name('materi.tambah');
    Route::get('/materi/edit/{id_materi}', [\App\Http\Controllers\Dosen\DetailKelasController::class, 'editMateri'])->name('materi.edit');
    Route::put('/materi/update/{id_materi}', [\App\Http\Controllers\Dosen\DetailKelasController::class, 'updateMateri'])->name('materi.update');
    Route::delete('/materi/hapus/{id_materi}', [\App\Http\Controllers\Dosen\DetailKelasController::class, 'hapusMateri'])->name('materi.hapus');

    // Tugas CRUD
    Route::post('/tugas/tambah', [\App\Http\Controllers\Dosen\DetailKelasController::class, 'tambahTugas'])->name('tugas.tambah');
    Route::delete('/tugas/hapus/{id_tugas}', [\App\Http\Controllers\Dosen\DetailKelasController::class, 'hapusTugas'])->name('tugas.hapus');

    // Nilai
    Route::get('/nilai/beri/{id_penilaian}', [\App\Http\Controllers\Dosen\NilaiController::class, 'create'])->name('nilai.create');
    Route::post('/nilai/store', [\App\Http\Controllers\Dosen\NilaiController::class, 'store'])->name('nilai.store');

    // Profile
    Route::get('/profile', [\App\Http\Controllers\Dosen\ProfileController::class, 'edit'])->name('profile');
    Route::put('/profile', [\App\Http\Controllers\Dosen\ProfileController::class, 'update'])->name('profile.update');
});

// Dosen
// Lihat pengumpulan tugas
Route::get('/pengumpulan/{id_tugas}/kelas/{id_kelas}', [App\Http\Controllers\Dosen\DetailKelasController::class, 'pengumpulan'])->name('pengumpulan');

// Beri nilai akhir
Route::get('/nilai-akhir/{id_kelas}/{id_mhs}', [App\Http\Controllers\Dosen\NilaiController::class, 'finalGradeForm'])->name('nilai.final.form');
Route::post('/nilai-akhir/{id_kelas}/{id_mhs}', [App\Http\Controllers\Dosen\NilaiController::class, 'finalGradeStore'])->name('nilai.final.store');

Route::middleware(['auth','role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Dosen\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/kelas', [App\Http\Controllers\Dosen\KelasController::class, 'index'])->name('kelas');
    Route::get('/kelas/{id_kelas}', [App\Http\Controllers\Dosen\DetailKelasController::class, 'show'])->name('kelas.detail');

// Materi
    Route::get('/materi/create/{id_kelas}', [App\Http\Controllers\Dosen\TugasController::class, 'createMateri'])->name('materi.create');
    Route::post('/materi', [App\Http\Controllers\Dosen\TugasController::class, 'storeMateri'])->name('materi.store');
    Route::get('/materi/{id_materi}/edit', [App\Http\Controllers\Dosen\TugasController::class, 'editMateri'])->name('materi.edit');
    Route::put('/materi/{id_materi}', [App\Http\Controllers\Dosen\TugasController::class, 'updateMateri'])->name('materi.update');
    Route::delete('/materi/{id_materi}', [App\Http\Controllers\Dosen\TugasController::class, 'destroyMateri'])->name('materi.destroy');

    // Tugas
    Route::get('/tugas/create/{id_kelas}', [App\Http\Controllers\Dosen\TugasController::class, 'createTugas'])->name('tugas.create');
    Route::post('/tugas', [App\Http\Controllers\Dosen\TugasController::class, 'storeTugas'])->name('tugas.store');
    Route::get('/tugas/{id_tugas}/edit', [App\Http\Controllers\Dosen\TugasController::class, 'editTugas'])->name('tugas.edit');
    Route::put('/tugas/{id_tugas}', [App\Http\Controllers\Dosen\TugasController::class, 'updateTugas'])->name('tugas.update');
    Route::delete('/tugas/{id_tugas}', [App\Http\Controllers\Dosen\TugasController::class, 'destroyTugas'])->name('tugas.destroy');

    // Nilai
    Route::get('/beri-nilai/{id_penilaian}', [App\Http\Controllers\Dosen\NilaiController::class, 'create'])->name('nilai.create');
    Route::post('/nilai', [App\Http\Controllers\Dosen\NilaiController::class, 'store'])->name('nilai.store');

    Route::get('/profile', [App\Http\Controllers\Dosen\ProfileController::class, 'edit'])->name('profile');
    Route::put('/profile', [App\Http\Controllers\Dosen\ProfileController::class, 'update'])->name('profile.update');
});

// Mahasiswa
Route::middleware(['auth','role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Mahasiswa\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/kelas', [App\Http\Controllers\Mahasiswa\KelasController::class, 'index'])->name('kelas');
    Route::get('/kelas/{id_kelas}', [App\Http\Controllers\Mahasiswa\DetailKelasController::class, 'show'])->name('kelas.detail');
    Route::post('/tugas/submit', [App\Http\Controllers\Mahasiswa\TugasController::class, 'submit'])->name('tugas.submit');
    Route::get('/profile', [App\Http\Controllers\Mahasiswa\ProfileController::class, 'edit'])->name('profile');
    Route::put('/profile', [App\Http\Controllers\Mahasiswa\ProfileController::class, 'update'])->name('profile.update');
});

    Route::get('/dashboard', function() {
        return redirect()->route('admin.dashboard');
    })->name('dashboard');

    // Admin Prodi Routes
    Route::prefix('admin-prodi')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('/profile', [ProfileController::class, 'update']);

        // Mahasiswa
        Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa');
        Route::post('/mahasiswa', [MahasiswaController::class, 'store']);
        Route::post('/mahasiswa/{id}', [MahasiswaController::class, 'update']);
        Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy']);

        // Dosen
        Route::get('/dosen', [DosenController::class, 'index'])->name('dosen');
        Route::post('/dosen', [DosenController::class, 'store']);
        Route::post('/dosen/{id}', [DosenController::class, 'update']);
        Route::delete('/dosen/{id}', [DosenController::class, 'destroy']);

        // Mata Kuliah
        Route::get('/matkul', [MatkulController::class, 'index'])->name('matkul');
        Route::post('/matkul', [MatkulController::class, 'store']);
        Route::post('/matkul/{id}', [MatkulController::class, 'update']);
        Route::delete('/matkul/{id}', [MatkulController::class, 'destroy']);

        // Kelas
        Route::get('/kelas', [KelasController::class, 'index'])->name('kelas');
        Route::post('/kelas', [KelasController::class, 'store']);
        Route::post('/kelas/{id}', [KelasController::class, 'update']);
        Route::delete('/kelas/{id}', [KelasController::class, 'destroy']);

        // Detail Kelas
        Route::get('/kelas/detail/{id_kelas}', [DetailKelasController::class, 'show'])->name('kelas.detail');

        // Peserta
        Route::get('/peserta', [PesertaController::class, 'index'])->name('peserta');
        Route::post('/peserta', [PesertaController::class, 'store']);
        Route::delete('/peserta/{id_peserta}', [PesertaController::class, 'destroy']);

        // Materi
        Route::get('/materi', [MateriController::class, 'index'])->name('materi');

        // Tugas
        Route::get('/tugas', [TugasController::class, 'index'])->name('tugas');
    });
});
