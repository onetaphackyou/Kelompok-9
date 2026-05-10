{{-- resources/views/admin_prodi/peserta.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola Peserta')
@section('active_peserta', 'active')

@section('content')
<h2 class="section-title">Kelola Peserta Kelas</h2>

<div class="card shadow-sm p-4 mb-4">
    <form method="GET" action="{{ route('admin_prodi.peserta') }}">
        <div class="row align-items-end">
            <div class="col-md-8 mb-3">
                <label class="form-label">Pilih Kelas</label>
                <select name="id_kelas" class="form-control" onchange="this.form.submit()">
                    <option value="">Pilih Kelas</option>
                    @foreach($kelas as $item)
                        <option value="{{ $item->id_kelas }}" {{ $id_kelas == $item->id_kelas ? 'selected' : '' }}>{{ $item->nama_kelas }} - {{ $item->mataKuliah->nama_matkul ?? '-' }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>
</div>

@if($info_kelas)
<div class="card shadow-sm p-4 mb-4">
    <h5>Info Kelas</h5>
    <p><strong>Kelas:</strong> {{ $info_kelas->nama_kelas }}</p>
    <p><strong>Mata Kuliah:</strong> {{ $info_kelas->mataKuliah->nama_matkul ?? '-' }}</p>
    <p><strong>Dosen:</strong> {{ $info_kelas->dosen->nama ?? '-' }}</p>
    <p><strong>Jumlah Peserta:</strong> {{ $peserta->count() }}</p>

    <div class="mt-3">
        <form method="POST" action="{{ route('admin_prodi.peserta') }}">
            @csrf
            <input type="hidden" name="id_kelas" value="{{ $id_kelas }}">
            <div class="row align-items-end">
                <div class="col-md-8 mb-3">
                    <label class="form-label">Tambah Mahasiswa</label>
                    <select name="id_mhs" class="form-control" required>
                        <option value="">Pilih Mahasiswa</option>
                        @foreach($mhs_available as $mhs)
                            <option value="{{ $mhs->id_mhs }}">{{ $mhs->nim ?? $mhs->nama }} - {{ $mhs->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <button type="submit" class="btn btn-primary w-100">Tambah Peserta</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="table-responsive" style="background:white;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,.08);">
    <table class="table table-hover mb-0">
        <thead style="background:#667eea;color:white;">
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peserta as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->mahasiswa->nim ?? '-' }}</td>
                    <td>{{ $item->mahasiswa->nama ?? '-' }}</td>
                    <td>{{ $item->mahasiswa->prodi ?? '-' }}</td>
                    <td>
                        <form action="{{ route('admin_prodi.peserta', $item->id_peserta) }}?id_kelas={{ $id_kelas }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus peserta ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">Belum ada peserta di kelas ini.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@else
<div class="alert alert-info">Silakan pilih kelas untuk melihat dan menambahkan peserta.</div>
@endif
@endsection
