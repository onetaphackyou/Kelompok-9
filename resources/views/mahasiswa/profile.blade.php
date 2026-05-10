@extends('layouts.app')

@section('title', 'Edit Profil Mahasiswa')
@section('active_profile', 'active')
@section('content')
<div class="profile-container">
    <div class="profile-header"><h2><i class="fas fa-user-edit"></i> Edit Profil Mahasiswa</h2></div>
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    <form method="POST">
        @csrf @method('PUT')
        <div class="form-row"><div class="form-group"><label>Nama Lengkap *</label><input type="text" name="nama" value="{{ $mhs->nama }}" required></div><div class="form-group"><label>NIM *</label><input type="text" name="nim" value="{{ $mhs->nim }}" required></div></div>
        <div class="form-row"><div class="form-group"><label>Email</label><input type="email" name="email" value="{{ $mhs->user->email ?? '' }}"></div></div>
        <div class="form-row"><div class="form-group"><label>Tempat Lahir</label><input type="text" name="tempat_lahir" value="{{ $mhs->tempat_lahir ?? '' }}"></div><div class="form-group"><label>Tanggal Lahir</label><input type="date" name="tanggal_lahir" value="{{ $mhs->tanggal_lahir ?? '' }}"></div></div>
        <div class="form-row"><div class="form-group"><label>Jenis Kelamin</label><select name="jenis_kelamin"><option value="">Pilih</option><option value="L" {{ $mhs->jenis_kelamin=='L'?'selected':'' }}>Laki-laki</option><option value="P" {{ $mhs->jenis_kelamin=='P'?'selected':'' }}>Perempuan</option></select></div><div class="form-group"><label>Agama</label><select name="agama"><option value="">Pilih</option><option value="Islam" {{ $mhs->agama=='Islam'?'selected':'' }}>Islam</option><option value="Kristen" {{ $mhs->agama=='Kristen'?'selected':'' }}>Kristen</option><option value="Katolik" {{ $mhs->agama=='Katolik'?'selected':'' }}>Katolik</option><option value="Hindu" {{ $mhs->agama=='Hindu'?'selected':'' }}>Hindu</option><option value="Buddha" {{ $mhs->agama=='Buddha'?'selected':'' }}>Buddha</option><option value="Konghucu" {{ $mhs->agama=='Konghucu'?'selected':'' }}>Konghucu</option></select></div></div>
        <div class="form-row"><div class="form-group"><label>Program Studi</label><input type="text" name="prodi" value="{{ $mhs->prodi ?? '' }}"></div><div class="form-group"><label>Periode</label><input type="text" name="periode" value="{{ $mhs->periode ?? '' }}"></div></div>
        <div class="btn-container"><button type="submit" class="btn-primary"><i class="fas fa-save"></i> Simpan</button><a href="{{ route('mahasiswa.dashboard') }}" class="btn-secondary">Kembali</a></div>
    </form>
</div>
@endsection
