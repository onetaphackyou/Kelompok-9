@extends('layouts.app')

@section('title', 'Edit Profil Dosen')
@section('active_profile', 'active')

@section('content')
<div class="profile-container">
    <div class="profile-header">
        <h2><i class="fas fa-user-edit"></i> Edit Profil Dosen</h2>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form method="POST">
        @csrf @method('PUT')
        <div class="form-row">
            <div class="form-group">
                <label>Nama Lengkap *</label>
                <input type="text" name="nama" value="{{ old('nama', $dosen->nama) }}" required>
            </div>
            <div class="form-group">
                <label>NIP *</label>
                <input type="text" name="nip" value="{{ old('nip', $dosen->nip) }}" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $dosen->user->email ?? '') }}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Jenis Kelamin *</label>
                <select name="jenis_kelamin" required>
                    <option value="">Pilih</option>
                    <option value="L" @selected($dosen->jenis_kelamin=='L')>Laki-laki</option>
                    <option value="P" @selected($dosen->jenis_kelamin=='P')>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Program Studi *</label>
                <input type="text" name="prodi" value="{{ $dosen->prodi }}" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Agama *</label>
                <select name="agama" required>
                    <option value="">Pilih</option>
                    @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $a)
                        <option value="{{ $a }}" @selected($dosen->agama == $a)>{{ $a }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Jenis Jabatan *</label>
                <input type="text" name="jenis_jabatan" value="{{ $dosen->jenis_jabatan }}" required>
            </div>
        </div>
        <div class="btn-container">
            <button type="submit" class="btn-primary">Simpan Perubahan</button>
            <a href="{{ route('dosen.dashboard') }}" class="btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
