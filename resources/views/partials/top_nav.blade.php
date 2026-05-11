<nav class="top-navbar">
    <div class="nav-left">
        <button class="hamburger-btn" id="hamburger-btn">
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
            <span class="hamburger-line"></span>
        </button>
        <div class="brand-title">Sistem Akademik</div>
    </div>
    @if(Auth::check())
        <div class="nav-actions">
            <span class="navbar-text">{{ Auth::user()->nama ?? Auth::user()->name }}</span>
            <a href="{{ route(Auth::user()->role . '.profile') }}" class="btn btn-sm btn-profile">Profil</a>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-logout">Logout</button>
            </form>
        </div>
    @endif
</nav>
