<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register LMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body.bg-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card {
            border-radius: 20px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        .btn-primary:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body class="bg-gradient">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-4">
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h3 class="fw-bold text-primary">LMS</h3>
                            <p class="text-muted">Register Akun Baru</p>
                        </div>
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nama</label>
                                <input type="text" name="nama" class="form-control form-control-lg" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" name="email" class="form-control form-control-lg" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Password</label>
                                <input type="password" name="password" class="form-control form-control-lg" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control form-control-lg" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 btn-lg fw-bold">
                                <i class="bi bi-person-plus"></i> Register
                            </button>
                        </form>
                        <div class="mt-3 text-center">
                            <a href="{{ route('login') }}">Sudah punya akun? Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
