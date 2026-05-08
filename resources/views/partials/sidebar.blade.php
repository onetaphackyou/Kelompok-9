<div class="sidebar" id="sidebar">
    @if(auth()->check())
        <h3>{{ ucfirst(auth()->user()->role) }} <button class="close-btn">&times;</button></h3>

        @if(auth()->user()->role == 'administrator')
            <a href="{{ route('administrator.dashboard') }}" class="@yield('active_dashboard')">Dashboard</a>
            <a href="{{ route('administrator.user.index') }}" class="@yield('active_user')">User</a>
            <div class="submenu">
                <h4>Data Master</h4>
                <div class="submenu-items">
                    <a href="{{ route('administrator.mahasiswa.index') }}">Mahasiswa</a>
                    <a href="{{ route('administrator.dosen.index') }}">Dosen</a>
                    <a href="{{ route('administrator.mata_kuliah.index') }}">Mata Kuliah</a>
                    <a href="{{ route('administrator.kelas_perkuliahan.index') }}">Kelas Perkuliahan</a>
                </div>
            </div>
        @elseif(auth()->user()->role == 'admin_prodi')
            <p class="prodi-info">Prodi: {{ session('prodi') }}</p>
            <a href="{{ route('admin_prodi.dashboard') }}" class="@yield('active_dashboard')">Dashboard</a>
            <a href="{{ route('admin_prodi.mahasiswa.index') }}">Mahasiswa</a>
            <a href="{{ route('admin_prodi.dosen.index') }}">Dosen</a>
            <a href="{{ route('admin_prodi.kelas.index') }}">Kelas</a>
        @elseif(auth()->user()->role == 'dosen')
            <a href="{{ route('dosen.dashboard') }}" class="@yield('active_dashboard')">Dashboard</a>
            <a href="{{ route('dosen.kelas') }}" class="@yield('active_kelas')">Kelas</a>
        @elseif(auth()->user()->role == 'mahasiswa')
            <a href="{{ route('mahasiswa.dashboard') }}" class="@yield('active_dashboard')">Dashboard</a>
            <a href="{{ route('mahasiswa.kelas') }}" class="@yield('active_kelas')">Kelas</a>
        @endif
    @else
        <h3>Menu <button class="close-btn">&times;</button></h3>
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
    @endif
</div>
