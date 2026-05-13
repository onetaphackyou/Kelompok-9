<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register LMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --lms-blue: #3b5bdb;
            --lms-indigo: #6c63ff;
            --lms-slate: #1f2937;
            --lms-slate-soft: #4b5563;
            --lms-surface: rgba(255, 255, 255, 0.14);
            --lms-border: rgba(255, 255, 255, 0.16);
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: radial-gradient(circle at top left, rgba(99, 102, 241, 0.28), transparent 24%),
                        radial-gradient(circle at bottom right, rgba(59, 130, 246, 0.2), transparent 28%),
                        linear-gradient(135deg, #141e30 0%, #243b55 100%);
            color: #f8fafc;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .login-card {
            width: 100%;
            max-width: 960px;
            border-radius: 28px;
            overflow: hidden;
            background: rgba(15, 23, 42, 0.9);
            box-shadow: 0 40px 80px rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .login-card .panel {
            padding: 3rem 2.5rem;
        }

        .login-card .panel-left {
            background: linear-gradient(180deg, rgba(59, 130, 246, 0.98), rgba(99, 102, 241, 0.97));
            color: #fff;
            position: relative;
        }

        .login-card .panel-left::before,
        .login-card .panel-left::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            filter: blur(50px);
            opacity: 0.65;
        }

        .login-card .panel-left::before {
            width: 180px;
            height: 180px;
            background: rgba(255, 255, 255, 0.18);
            top: -50px;
            right: -50px;
        }

        .login-card .panel-left::after {
            width: 130px;
            height: 130px;
            background: rgba(255, 255, 255, 0.12);
            bottom: -35px;
            left: -35px;
        }

        .login-card h1 {
            font-size: clamp(2rem, 2.5vw, 2.6rem);
            letter-spacing: -0.02em;
            margin-bottom: 1rem;
        }

        .login-card p.lead {
            color: rgba(255, 255, 255, 0.88);
            margin-bottom: 2.25rem;
            line-height: 1.75;
        }

        .brand-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 2rem;
            font-size: 0.95rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            opacity: 0.95;
        }

        .brand-badge span {
            width: 44px;
            height: 44px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.18);
        }

        .login-card .panel-right {
            background: #0f172a;
        }

        .login-card .form-control {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: #e2e8f0;
            border-radius: 16px;
            padding: 1rem 1.15rem;
            transition: all 0.25s ease;
        }

        .login-card .form-control:focus {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(99, 102, 241, 0.85);
            box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.15);
            color: #fff;
        }

        .form-label {
            color: rgba(226, 232, 240, 0.85);
            font-weight: 600;
        }

        .login-card .btn-primary {
            width: 100%;
            padding: 0.95rem 1.2rem;
            border-radius: 16px;
            border: none;
            font-weight: 700;
            letter-spacing: 0.03em;
            background: linear-gradient(135deg, #60a5fa 0%, #8b5cf6 100%);
            box-shadow: 0 18px 40px rgba(99, 102, 241, 0.22);
        }

        .login-card .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 22px 48px rgba(99, 102, 241, 0.26);
        }

        .login-card .login-note {
            color: rgba(148, 163, 184, 0.92);
            margin-top: 0.75rem;
            font-size: 0.95rem;
        }

        .login-card .form-text a {
            color: #93c5fd;
            text-decoration: none;
        }

        .login-card .form-text a:hover {
            color: #fff;
            text-decoration: underline;
        }

        .input-group-icon {
            position: relative;
        }

        .input-group-icon .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(148, 163, 184, 0.9);
            font-size: 1.05rem;
        }

        .input-group-icon .form-control {
            padding-left: 3.2rem;
        }

        .alert-custom {
            background: rgba(220, 38, 38, 0.12);
            border: 1px solid rgba(220, 38, 38, 0.3);
            color: #fee2e2;
            border-radius: 16px;
        }

        .form-error {
            margin-top: 0.5rem;
            font-size: 0.9rem;
            color: #fca5a5;
        }

        @media (max-width: 991px) {
            .login-card {
                max-width: 720px;
            }
        }

        @media (max-width: 767px) {
            .login-card {
                border-radius: 24px;
            }

            .login-card .panel {
                padding: 2rem 1.75rem;
            }

            .login-card .panel-left,
            .login-card .panel-right {
                padding: 2rem 1.75rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card row g-0 overflow-hidden">
            <div class="col-lg-6 panel panel-left d-flex flex-column justify-content-center">
                <div class="brand-badge">
                    <span><i class="bi bi-book-half"></i></span>
                    LMS Portal
                </div>
                <h1>Buat Akun LMS</h1>
                <p class="lead">Daftar untuk mengelola kelas, materi, tugas, dan penilaian dengan pengalaman LMS yang profesional.</p>
                <p class="login-note">Akses cepat untuk mahasiswa, dosen, dan admin prodi.</p>
            </div>

            <div class="col-lg-6 panel panel-right">
                <div class="mb-4 text-center">
                    <h2 class="mb-1">Daftar</h2>
                    <p class="text-secondary">Masukkan data akun Anda untuk mulai menggunakan LMS</p>
                </div>

                @if(session('error'))
                    <div class="alert alert-custom alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3 input-group-icon">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <i class="bi bi-person-badge input-icon"></i>
                        <input id="name" type="text" name="nama" value="{{ old('nama') }}" class="form-control form-control-lg @error('nama') is-invalid @enderror" required autofocus placeholder="Masukkan nama lengkap" style="color: white;">
                        @error('nama')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 input-group-icon">
                        <label for="email" class="form-label">Email</label>
                        <i class="bi bi-envelope-fill input-icon"></i>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control form-control-lg @error('email') is-invalid @enderror" required placeholder="Masukkan email" style="color: white;">
                        @error('email')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 input-group-icon">
                        <label for="password" class="form-label">Password</label>
                        <i class="bi bi-lock-fill input-icon"></i>
                        <input id="password" type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" required placeholder="Masukkan password" style="color: white;">
                        @error('password')
                            <div class="form-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4 input-group-icon">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <i class="bi bi-lock-fill input-icon"></i>
                        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control form-control-lg" required placeholder="Ulangi password" style="color: white;">
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg mb-3">
                        <i class="bi bi-person-plus me-2"></i> Daftar Akun
                    </button>

                    <div class="form-text text-center" style="color: white;">
                        Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
