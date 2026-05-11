{{-- resources/views/admin_prodi/kelas.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola Kelas')
@section('active_kelas', 'active')

@section('content')
<h2 class="section-title">Kelola Kelas</h2>

@if($action === 'add' || $action === 'edit')
<div class="card shadow-sm p-4 mb-4">
    <h5 class="mb-3">{{ $action === 'add' ? 'Tambah Kelas' : 'Edit Kelas' }}</h5>

    <form method="POST" action="{{ $action === 'add' ? route('admin_prodi.kelas') : route('admin_prodi.kelas.update', $edit_data->id_kelas) }}">
        @csrf
        @if($action === 'edit') @method('POST') @endif

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Mata Kuliah</label>
                <select name="id_matkul" class="form-control" required>
                    <option value="">Pilih Mata Kuliah</option>
                    @foreach($matkul as $item)
                        <option value="{{ $item->id_matkul }}" {{ ($edit_data->id_matkul ?? '') == $item->id_matkul ? 'selected' : '' }}>{{ $item->nama_matkul }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Dosen</label>
                <select name="id_dosen" class="form-control" required>
                    <option value="">Pilih Dosen</option>
                    @foreach($dosen as $item)
                        <option value="{{ $item->id_dosen }}" {{ ($edit_data->id_dosen ?? '') == $item->id_dosen ? 'selected' : '' }}>{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Nama Kelas</label>
                <input type="text" name="nama_kelas" class="form-control" value="{{ $edit_data->nama_kelas ?? '' }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 mb-3">
                <label class="form-label">Hari</label>
                <input type="text" name="hari" class="form-control" value="{{ $edit_data->hari ?? '' }}" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Jam Awal</label>
                <input type="time" name="jam_awal" class="form-control" value="{{ $edit_data->jam_awal ?? '' }}" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Jam Akhir</label>
                <input type="time" name="jam_akhir" class="form-control" value="{{ $edit_data->jam_akhir ?? '' }}" required>
            </div>
            <div class="col-md-3 mb-3">
                <label class="form-label">Ruangan</label>
                <input type="text" name="ruangan" class="form-control" value="{{ $edit_data->ruangan ?? '' }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Periode</label>
                <input type="text" name="periode" class="form-control" value="{{ $edit_data->periode ?? '' }}" required>
            </div>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin_prodi.kelas') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endif

<div class="table-responsive" style="background:white;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,.08);">
    <table class="table table-hover mb-0">
        <thead style="background:#667eea;color:white;">
            <tr>
                <th>No</th>
                <th>Nama Kelas</th>
                <th>Mata Kuliah</th>
                <th>Dosen</th>
                <th>Hari</th>
                <th>Jam</th>
                <th>Ruangan</th>
                <th>Periode</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kelas as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->nama_kelas }}</td>
                    <td>{{ $item->mataKuliah->nama_matkul ?? '-' }}</td>
                    <td>{{ $item->dosen->nama ?? '-' }}</td>
                    <td>{{ $item->hari }}</td>
                    <td>{{ $item->jam_awal }} - {{ $item->jam_akhir }}</td>
                    <td>{{ $item->ruangan }}</td>
                    <td>{{ $item->periode }}</td>
                    <td>
                        <a href="{{ route('admin_prodi.kelas', ['action' => 'edit', 'id' => $item->id_kelas]) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('admin_prodi.kelas.detail', $item->id_kelas) }}" class="btn btn-info btn-sm">Detail</a>
                        <form action="{{ route('admin_prodi.kelas.destroy', $item->id_kelas) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus kelas ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="9">Belum ada kelas untuk program studi ini.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
