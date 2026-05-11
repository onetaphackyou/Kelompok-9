{{-- resources/views/admin_prodi/mahasiswa.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola Mahasiswa')
@section('active_mahasiswa', 'active')

@section('content')
<h2 class="section-title">Kelola Mahasiswa</h2>

@if($action === 'add' || $action === 'edit')
<div class="card shadow-sm p-4">
    <h5 class="mb-3">{{ $action === 'add' ? 'Tambah Mahasiswa' : 'Edit Mahasiswa' }}</h5>

    <form method="POST" action="{{ $action === 'add' ? route('admin_prodi.mahasiswa') : route('admin_prodi.mahasiswa.update', $edit->id_mhs) }}">
        @csrf
        @if($action === 'edit') @method('POST') @endif
        <input type="hidden" name="action_type" value="{{ $action }}">
        @if($edit) <input type="hidden" name="id_mhs" value="{{ $edit->id_mhs }}"> @endif

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">NIM</label>
                <input type="text" name="nim" class="form-control" value="{{ $edit->nim ?? '' }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Nama Mahasiswa</label>
                <input type="text" name="nama" class="form-control" value="{{ $edit->nama ?? '' }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control">
                    <option value="L" {{ ($edit->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ ($edit->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" value="{{ $edit->tempat_lahir ?? '' }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="{{ $edit->tanggal_lahir ?? '' }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Agama</label>
                <select name="agama" class="form-control">
                    <option value="">Pilih Agama</option>
                    <option value="Islam" {{ ($edit->agama ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
                    <option value="Kristen" {{ ($edit->agama ?? '') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                    <option value="Katolik" {{ ($edit->agama ?? '') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                    <option value="Hindu" {{ ($edit->agama ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                    <option value="Buddha" {{ ($edit->agama ?? '') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                    <option value="Konghucu" {{ ($edit->agama ?? '') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Program Studi</label>
                <input type="text" name="prodi" class="form-control" value="{{ $edit->prodi ?? $admin_prodi }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Periode</label>
                <input type="text" name="periode" class="form-control" value="{{ $edit->periode ?? '' }}" required>
            </div>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin_prodi.mahasiswa') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@else
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin_prodi.mahasiswa', ['action' => 'add']) }}" class="btn btn-success">Tambah Mahasiswa</a>
</div>

<div class="table-responsive" style="background:white;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,.08);">
    <table class="table table-hover mb-0">
        <thead style="background:#667eea;color:white;">
            <tr>
                <th>No</th><th>NIM</th><th>Nama</th><th>Tempat Lahir</th><th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th><th>Agama</th><th>Prodi</th><th>Periode</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $no => $r)
            <tr>
                <td>{{ $no+1 }}</td>
                <td>{{ $r->nim }}</td>
                <td>{{ $r->nama }}</td>
                <td>{{ $r->tempat_lahir ?? '-' }}</td>
                <td>{{ $r->tanggal_lahir ?? '-' }}</td>
                <td>{{ $r->jenis_kelamin === 'L' ? 'Laki-laki' : ($r->jenis_kelamin === 'P' ? 'Perempuan' : '-') }}</td>
                <td>{{ $r->agama ?? '-' }}</td>
                <td>{{ $r->prodi }}</td>
                <td>{{ $r->periode }}</td>
                <td>
                    <a href="{{ route('admin_prodi.mahasiswa', ['action' => 'edit', 'id' => $r->id_mhs]) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin_prodi.mahasiswa.destroy', $r->id_mhs) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus data mahasiswa?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection

