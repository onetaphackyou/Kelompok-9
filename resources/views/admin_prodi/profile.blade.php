{{-- resources/views/admin_prodi/profile.blade.php --}}
@extends('layouts.admin')

@section('title', 'Profil Admin Prodi')
@section('active_profile', 'active')

@section('content')
<h2 class="section-title">Profil Admin Prodi</h2>

<div class="card shadow-sm p-4 mb-4">
    <form method="POST" action="{{ route('admin_prodi.profile') }}">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ $user->nama }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Program Studi</label>
                <input type="text" name="prodi" class="form-control" value="{{ $admin_prodi }}" required>
            </div>
        </div>

        <button class="btn btn-primary">Simpan Profil</button>
    </form>
</div>
@endsection
