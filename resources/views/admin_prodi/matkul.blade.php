{{-- resources/views/admin_prodi/matkul.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola Mata Kuliah')
@section('active_matkul', 'active')

@section('content')
<h2 class="section-title">Kelola Mata Kuliah</h2>

@if($action === 'add' || $action === 'edit')
<div class="card shadow-sm p-4 mb-4">
    <h5 class="mb-3">{{ $action === 'add' ? 'Tambah Mata Kuliah' : 'Edit Mata Kuliah' }}</h5>

    <form method="POST" action="{{ $action === 'add' ? route('admin_prodi.matkul') : route('admin_prodi.matkul', $edit_data->id_matkul) }}">
        @csrf
        @if($action === 'edit') @method('POST') @endif

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nama Mata Kuliah</label>
                <input type="text" name="nama_matkul" class="form-control" value="{{ $edit_data->nama_matkul ?? '' }}" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">SKS</label>
                <input type="number" name="sks" class="form-control" value="{{ $edit_data->sks ?? '' }}" min="1" max="6" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Semester</label>
                <input type="number" name="semester" class="form-control" value="{{ $edit_data->semester ?? '' }}" min="1" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Jenis Mata Kuliah</label>
                <input type="text" name="jenis_matkul" class="form-control" value="{{ $edit_data->jenis_matkul ?? '' }}" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Program Studi</label>
                <input type="text" name="prodi" class="form-control" value="{{ $edit_data->prodi ?? $admin_prodi }}" required>
            </div>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin_prodi.matkul') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endif

<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin_prodi.matkul', ['action' => 'add']) }}" class="btn btn-success">Tambah Mata Kuliah</a>
</div>

<div class="table-responsive" style="background:white;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,.08);">
    <table class="table table-hover mb-0">
        <thead style="background:#667eea;color:white;">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>SKS</th>
                <th>Semester</th>
                <th>Jenis</th>
                <th>Prodi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($matkul as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama_matkul }}</td>
                    <td>{{ $item->sks }}</td>
                    <td>{{ $item->semester }}</td>
                    <td>{{ $item->jenis_matkul }}</td>
                    <td>{{ $item->prodi }}</td>
                    <td>
                        <a href="{{ route('admin_prodi.matkul', ['action' => 'edit', 'id' => $item->id_matkul]) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin_prodi.matkul', $item->id_matkul) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus mata kuliah ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7">Belum ada mata kuliah untuk program studi ini.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
