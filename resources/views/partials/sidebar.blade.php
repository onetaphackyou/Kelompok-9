<div class="sidebar" id="sidebar">
    @if(auth()->check())
        <div class="sidebar-header">
            <div>
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                    <div style="background: rgba(255,255,255,0.2); border-radius: 8px; padding: 6px 8px;">
                        <i class="fas fa-graduation-cap" style="font-size: 1.2rem;"></i>
                    </div>
                    <div>
                        <div style="font-size: 0.65rem; opacity: 0.75; letter-spacing: 1px; text-transform: uppercase;">Portal</div>
                        <div style="font-size: 0.95rem; font-weight: 700; line-height: 1.2;">Learning Management</div>
                        <div style="font-size: 0.95rem; font-weight: 700; line-height: 1.2;">System</div>
                    </div>
                </div>
            </div>
            <button class="close-btn">&times;</button>
        </div>

        <div class="sidebar-content">

            @if(auth()->user()->role == 'administrator')
                <div class="sidebar-section">
                    <a href="{{ route('administrator.dashboard') }}" class="@yield('active_dashboard')">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                    <a href="{{ route('administrator.user.index') }}" class="@yield('active_user')">
                        <i class="fas fa-user-cog"></i> Kelola User
                    </a>
                    <a href="{{ route('administrator.mahasiswa.index') }}" class="@yield('active_mahasiswa')">
                        <i class="fas fa-user-graduate"></i> Mahasiswa
                    </a>
                    <a href="{{ route('administrator.dosen.index') }}" class="@yield('active_dosen')">
                        <i class="fas fa-chalkboard-teacher"></i> Dosen
                    </a>
                    <a href="{{ route('administrator.mata_kuliah.index') }}" class="@yield('active_mata_kuliah')">
                        <i class="fas fa-book"></i> Mata Kuliah
                    </a>
                    <a href="{{ route('administrator.kelas_perkuliahan.index') }}" class="@yield('active_kelas_perkuliahan')">
                        <i class="fas fa-school"></i> Kelas Perkuliahan
                    </a>
                </div>

            @elseif(auth()->user()->role == 'admin_prodi')
                <div class="sidebar-section admin-prodi-menu">
                    <a href="{{ route('admin_prodi.dashboard') }}" class="@yield('active_dashboard')">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                    <a href="{{ route('admin_prodi.mahasiswa') }}" class="@yield('active_mahasiswa')">
                        <i class="fas fa-user-graduate"></i> Mahasiswa
                    </a>
                    <a href="{{ route('admin_prodi.dosen') }}" class="@yield('active_dosen')">
                        <i class="fas fa-chalkboard-teacher"></i> Dosen
                    </a>
                    <a href="{{ route('admin_prodi.matkul') }}" class="@yield('active_matkul')">
                        <i class="fas fa-book"></i> Mata Kuliah
                    </a>
                    <a href="{{ route('admin_prodi.kelas') }}" class="@yield('active_kelas')">
                        <i class="fas fa-school"></i> Kelas
                    </a>
                    <a href="{{ route('admin_prodi.peserta') }}" class="@yield('active_peserta')">
                        <i class="fas fa-users"></i> Peserta
                    </a>
                    <a href="{{ route('admin_prodi.jadwal') }}" class="@yield('active_jadwal')">
                        <i class="fas fa-calendar-alt"></i> Jadwal
                    </a>
                </div>

            @elseif(auth()->user()->role == 'dosen')
                <div class="sidebar-section">
                    <a href="{{ route('dosen.dashboard') }}" class="@yield('active_dashboard')">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                    <a href="{{ route('dosen.kelas') }}" class="@yield('active_kelas')">
                        <i class="fas fa-school"></i> Kelas Saya
                    </a>
                    <a href="{{ route('dosen.materi.page') }}" class="@yield('active_materi')">
                        <i class="fas fa-file-alt"></i> Materi
                    </a>
                    <a href="{{ route('dosen.tugas.page') }}" class="@yield('active_tugas')">
                        <i class="fas fa-tasks"></i> Tugas
                    </a>
                    <a href="{{ route('dosen.pengumuman.index') }}" class="@yield('active_pengumuman')">
                        <i class="fas fa-bullhorn"></i> Pengumuman
                    </a>
                    <a href="{{ route('dosen.jadwal') }}" class="@yield('active_jadwal')">
                        <i class="fas fa-calendar-alt"></i> Jadwal
                    </a>
                </div>

            @elseif(auth()->user()->role == 'mahasiswa')
                <div class="sidebar-section">
                    <a href="{{ route('mahasiswa.dashboard') }}" class="@yield('active_dashboard')">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                    <a href="{{ route('mahasiswa.kelas') }}" class="@yield('active_kelas')">
                        <i class="fas fa-school"></i> Perkuliahan
                    </a>
                    <a href="{{ route('mahasiswa.materi') }}" class="@yield('active_materi')">
                        <i class="fas fa-file-alt"></i> Materi
                    </a>
                    <a href="{{ route('mahasiswa.tugas') }}" class="@yield('active_tugas')">
                        <i class="fas fa-tasks"></i> Tugas
                    </a>
                    <a href="{{ route('mahasiswa.pengumuman.all') }}" class="@yield('active_pengumuman')">
                        <i class="fas fa-bullhorn"></i> Pengumuman
                    </a>
                    <a href="{{ route('mahasiswa.nilai') }}" class="@yield('active_nilai')">
                        <i class="fas fa-star"></i> Nilai
                    </a>
                    <a href="{{ route('mahasiswa.jadwal') }}" class="@yield('active_jadwal')">
                        <i class="fas fa-calendar-alt"></i> Jadwal
                    </a>
                </div>
            @endif

        </div>

    @else
        <div class="sidebar-header">
            <h3>Menu</h3>
            <button class="close-btn">&times;</button>
        </div>
        <div class="sidebar-content">
            <div class="sidebar-section">
                <a href="{{ route('login') }}">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
            </div>
        </div>
    @endif
</div>