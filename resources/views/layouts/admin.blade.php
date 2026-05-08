<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | {{ ucfirst(Auth::user()->role) }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles')
</head>
<body class="{{ Auth::user()->role }}">
    <div class="sidebar" id="sidebar">
        <h3>{{ ucfirst(Auth::user()->role) }} <button class="close-btn">&times;</button></h3>
        @if (Auth::user()->role == 'administrator')
            <a href="{{ route('administrator.dashboard') }}" class="@yield('active_dashboard')">Dashboard</a>
            <a href="{{ route('administrator.user.index') }}" class="@yield('active_user')">User</a>
            <div class="submenu">
                <h4>Data Master</h4>
                <div class="submenu-items">
                    <a href="{{ route('administrator.mahasiswa.index') }}" class="@yield('active_mahasiswa')">Mahasiswa</a>
                    <a href="{{ route('administrator.dosen.index') }}" class="@yield('active_dosen')">Dosen</a>
                    <a href="{{ route('administrator.mata_kuliah.index') }}" class="@yield('active_matkul')">Mata Kuliah</a>
                    <a href="{{ route('administrator.kelas_perkuliahan.index') }}" class="@yield('active_kelas')">Kelas Perkuliahan</a>
                </div>
            </div>
        @elseif (Auth::user()->role == 'admin_prodi')
            {{-- menu admin prodi --}}
        @elseif (Auth::user()->role == 'dosen')
            {{-- menu dosen --}}
        @elseif (Auth::user()->role == 'mahasiswa')
            {{-- menu mahasiswa --}}
        @endif
    </div>

    <div class="main">
        <div class="header">
            <div class="logo">Sistem Akademik</div>
            <div class="profil">
                <span class="user-name">{{ Auth::user()->nama }}</span>
                @if (Auth::user()->role == 'administrator')
                    <a href="{{ route('administrator.profile') }}"><i class="fas fa-user"></i> Profil</a>
                @endif
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/cusstom.js') }}"></script>
    @stack('scripts')
</body>
</html>
