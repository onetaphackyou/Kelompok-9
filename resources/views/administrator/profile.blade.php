@extends('layouts.app')

@section('title', 'Edit Profil')
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush

@section('content')
<h2 class="section-title"><i class="fas fa-user-edit"></i> Edit Profil Administrator</h2>
<p class="mb-4">Kelola informasi profil Anda</p>

<div class="card">
    <div class="card-body">
        <form method="POST">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="username" class="form-label">Username *</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ $user->nama }}" required>
                </div>
                <div class="col-md-6">
                    <label for="role" class="form-label">Role</label>
                    <input type="text" class="form-control" id="role" value="Administrator" readonly>
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password Baru <small class="text-muted">(Isi jika ingin mengubah password)</small></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('administrator.dashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
