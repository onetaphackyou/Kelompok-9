{{-- resources/views/admin_prodi/dosen.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola Dosen')
@section('active_dosen', 'active')

@section('content')
<h2 class="section-title">Kelola Dosen</h2>

@if($action === 'add' || $action === 'edit')
<div class="card shadow-sm p-4 mb-4">
    <h5 class="mb-3">{{ $action === 'add' ? 'Tambah Dosen' : 'Edit Dosen' }}</h5>

    <form method="POST" action="{{ $action === 'add' ? route('admin_prodi.dosen') : route('admin_prodi.dosen.update', $edit->id_dosen) }}">
        @csrf
        @if($action === 'edit') @method('POST') @endif

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">NIP</label>
                <input type="text" name="nip" class="form-control" value="{{ $edit->nip ?? '' }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ $edit->nama ?? '' }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="">Pilih</option>
                    <option value="L" {{ ($edit->jenis_kelamin ?? '') === 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ ($edit->jenis_kelamin ?? '') === 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" value="{{ $edit->tempat_lahir ?? '' }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="{{ $edit->tanggal_lahir ?? '' }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Agama</label>
                <select name="agama" class="form-control">
                    <option value="">Pilih Agama</option>
                    @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $agama)
                        <option value="{{ $agama }}" {{ ($edit->agama ?? '') === $agama ? 'selected' : '' }}>{{ $agama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Jenis Jabatan</label>
                <input type="text" name="jenis_jabatan" class="form-control" value="{{ $edit->jenis_jabatan ?? '' }}">
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Program Studi</label>
                <input type="text" name="prodi" class="form-control" value="{{ $edit->prodi ?? $admin_prodi }}" required>
            </div>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin_prodi.dosen') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endif

<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin_prodi.dosen', ['action' => 'add']) }}" class="btn btn-success">Tambah Dosen</a>
</div>

<div class="table-responsive" style="background:white;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,.08);">
    <table class="table table-hover mb-0">
        <thead style="background:#667eea;color:white;">
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Prodi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nip }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jenis_kelamin === 'L' ? 'Laki-laki' : ($item->jenis_kelamin === 'P' ? 'Perempuan' : '-') }}</td>
                    <td>{{ $item->prodi }}</td>
                    <td>
                        <a href="{{ route('admin_prodi.dosen', ['action' => 'edit', 'id' => $item->id_dosen]) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin_prodi.dosen.destroy', $item->id_dosen) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus data dosen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">Belum ada dosen untuk program studi ini.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
