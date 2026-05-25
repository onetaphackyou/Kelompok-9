<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | {{ ucfirst(Auth::user()->role) }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
    @stack('styles')
</head>
<body class="{{ Auth::user()->role }}">
    @include('partials.sidebar')

    <div class="main">
        <div class="header">
            <button class="hamburger-btn" id="hamburger-btn">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>
            <div class="logo">Sistem Akademik</div>
            <div class="profil">
                <div class="dropdown">
                    <button class="btn btn-profile dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="profile-info">
                            <div class="profile-avatar">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <div class="profile-details">
                                <span class="user-name">{{ Auth::user()->nama }}</span>
                                <span class="user-role">{{ ucfirst(Auth::user()->role) }}</span>
                            </div>
                        </div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end profile-dropdown-menu" aria-labelledby="profileDropdown">
                        @php
                            $user = Auth::user();
                            $role = $user->role;
                            $profileData = [];

                            if ($role === 'mahasiswa') {
$mahasiswa = $user->id ? \App\Models\Mahasiswa::where('id_user', $user->id)->first() : null;
                                $profileData = [
                                    'nama' => $mahasiswa->nama ?? $user->nama,
                                    'identifier' => 'NIM: ' . ($mahasiswa->nim ?? '-'),
                                    'route' => route('mahasiswa.profile')
                                ];
                            } elseif ($role === 'dosen') {
$dosen = $user->id ? \App\Models\Dosen::where('id_user', $user->id)->first() : null;
                                $profileData = [
                                    'nama' => $dosen->nama ?? $user->nama,
'identifier' => 'NIDN: ' . ($dosen->nip ?? '-'),
                                    'route' => route('dosen.profile')
                                ];
                            } elseif ($role === 'admin_prodi') {
                                $profileData = [
                                    'nama' => $user->nama,
                                    'identifier' => 'Admin Prodi',
                                    'route' => route('admin_prodi.profile')
                                ];
                            } elseif ($role === 'administrator') {
                                $profileData = [
                                    'nama' => $user->nama,
                                    'identifier' => 'Administrator',
                                    'route' => route('administrator.profile')
                                ];
                            }
                        @endphp

                        <!-- User Info Section -->
                        <li class="user-info-section">
                            <div class="user-info">
                                <div class="user-info-name">{{ $profileData['nama'] ?? $user->nama }}</div>
                                <div class="user-info-identifier">{{ $profileData['identifier'] ?? ucfirst($role) }}</div>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider"></li>

                        <!-- Edit Profile Link -->
                        <li><a class="dropdown-item edit-profile-link" href="{{ $profileData['route'] ?? '#' }}">
                            <i class="fas fa-edit"></i> Edit Profil
                        </a></li>
                        <li><hr class="dropdown-divider"></li>

                        <!-- Logout -->
                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="dropdown-item logout-btn">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        @if(session('msg'))
            <div class="alert alert-{{ session('msg_type', 'info') }} alert-dismissible fade show" role="alert">
                {{ session('msg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/custom.js"></script>
    @stack('scripts')
</body>
</html>