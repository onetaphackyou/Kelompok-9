<div class="sidebar" id="sidebar">
    @if(auth()->check())
        <div class="sidebar-header">
            <h3>{{ ucfirst(auth()->user()->role) }}</h3>
            <button class="close-btn">&times;</button>
        </div>

        <div class="sidebar-content">
            <!-- DASHBOARD -->
            <div class="sidebar-section">
                <a href="{{ route(auth()->user()->role . '.dashboard') }}" class="@yield('active_dashboard')">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </div>

            @if(auth()->user()->role == 'administrator')
                <!-- USER MANAGEMENT -->
                <div class="sidebar-section">
                    <h4><i class="fas fa-users"></i> User Management</h4>
                    <a href="{{ route('administrator.user.index') }}" class="@yield('active_user')">
                        <i class="fas fa-user-cog"></i> Kelola User
                    </a>
                </div>

                <!-- DATA MASTER -->
                <div class="sidebar-section">
                    <h4><i class="fas fa-database"></i> Data Master</h4>
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
                <!-- INFO PRODI -->
                <div class="sidebar-section">
                    <div class="prodi-info">
                        <i class="fas fa-university"></i> Prodi: {{ session('prodi') }}
                    </div>
                </div>

                <!-- AKADEMIK -->
                <div class="sidebar-section">
                    <h4><i class="fas fa-graduation-cap"></i> Akademik</h4>
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
                </div>

                <!-- PERKULIAHAN -->
                <div class="sidebar-section">
                    <h4><i class="fas fa-chalkboard"></i> Perkuliahan</h4>
                    <a href="{{ route('admin_prodi.peserta') }}" class="@yield('active_peserta')">
                        <i class="fas fa-users"></i> Peserta
                    </a>
                    <a href="{{ route('admin_prodi.materi') }}" class="@yield('active_materi')">
                        <i class="fas fa-file-alt"></i> Materi
                    </a>
                    <a href="{{ route('admin_prodi.tugas') }}" class="@yield('active_tugas')">
                        <i class="fas fa-tasks"></i> Tugas
                    </a>
                </div>

            @elseif(auth()->user()->role == 'dosen')
                <!-- PERKULIAHAN -->
                <div class="sidebar-section">
                    <h4><i class="fas fa-chalkboard-teacher"></i> Perkuliahan</h4>
                    <a href="{{ route('dosen.kelas') }}" class="@yield('active_kelas')">
                        <i class="fas fa-school"></i> Kelas Saya
                    </a>
                </div>

            @elseif(auth()->user()->role == 'mahasiswa')
                <!-- AKADEMIK -->
                <div class="sidebar-section">
                    <h4><i class="fas fa-graduation-cap"></i> Akademik</h4>
                    <a href="{{ route('mahasiswa.kelas') }}" class="@yield('active_kelas')">
                        <i class="fas fa-school"></i> Kelas Saya
                    </a>
                </div>
            @endif

            <!-- PROFILE -->
            <div class="sidebar-section">
                <h4><i class="fas fa-user"></i> Akun</h4>
                <a href="{{ route(auth()->user()->role . '.profile') }}" class="@yield('active_profile')">
                    <i class="fas fa-user-edit"></i> Profil
                </a>
            </div>
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
                <a href="{{ route('register') }}">
                    <i class="fas fa-user-plus"></i> Register
                </a>
            </div>
        </div>
    @endif
</div>
