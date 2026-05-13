@extends('layouts.admin')

@section('title', 'Lengkapi Profil Mahasiswa')
@section('content')
<div class="profile-container">
    <div class="profile-header"><h2><i class="fas fa-user-plus"></i> Lengkapi Profil Mahasiswa</h2></div>
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    <form method="POST">
        @csrf
        <div class="form-row"><div class="form-group"><label>Nama Lengkap *</label><input type="text" name="nama" value="{{ old('nama', Auth::user()->nama) }}" required></div><div class="form-group"><label>NIM *</label><input type="text" name="nim" value="{{ old('nim') }}" required></div></div>
        <div class="form-row"><div class="form-group"><label>Tempat Lahir</label><input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}"></div><div class="form-group"><label>Tanggal Lahir</label><input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"></div></div>
        <div class="form-row"><div class="form-group"><label>Jenis Kelamin *</label><select name="jenis_kelamin" required><option value="">Pilih</option><option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option><option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option></select></div><div class="form-group"><label>Agama</label><select name="agama"><option value="">Pilih</option><option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option><option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option><option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option><option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option><option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option><option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option></select></div></div>
        <div class="form-row"><div class="form-group"><label>Program Studi</label><input type="text" name="prodi" value="{{ old('prodi') }}"></div><div class="form-group"><label>Periode</label><input type="text" name="periode" value="{{ old('periode') }}"></div></div>
        <div class="btn-container"><button type="submit" class="btn-primary"><i class="fas fa-save"></i> Simpan Profil</button></div>
    </form>
</div>
@endsection
