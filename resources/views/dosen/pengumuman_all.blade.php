@extends('layouts.admin')

@section('title', 'Pengumuman')
@section('active_pengumuman', 'active')

@section('content')
<h4 class="mb-4 section-title"><i class="fas fa-bullhorn me-2"></i>Pengumuman</h4>

<div class="card mb-4">
    <div class="card-header"><h5 class="mb-0">Tambah Pengumuman</h5></div>
    <div class="card-body">
        <form action="{{ route('dosen.pengumuman.index.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <select name="id_kelas" class="form-select" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($kelas_list as $k)
                        <option value="{{ $k->id_kelas }}">{{ $k->mataKuliah->nama_matkul }} - {{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" name="judul" class="form-control" placeholder="Judul Pengumuman" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="isi" class="form-control" placeholder="Isi Pengumuman" required>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success w-100">+ Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>

@forelse($pengumuman_list as $p)
<div class="card mb-3" style="border-left: 4px solid #0d6efd;">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <span class="badge bg-primary mb-2">{{ $p->kelas->mataKuliah->nama_matkul }}</span>
                <h6 class="fw-bold mb-1">{{ $p->judul }}</h6>
                <p class="mb-1">{{ $p->isi }}</p>
                <small class="text-muted"><i class="fas fa-clock me-1"></i>{{ $p->created_at->diffForHumans() }}</small>
            </div>
            <form action="{{ route('dosen.pengumuman.index.hapus', $p->id_pengumuman) }}" method="POST" onsubmit="return confirm('Hapus pengumuman?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
            </form>
        </div>
    </div>
</div>
@empty
<div class="card p-4 text-center text-muted">
    <i class="fas fa-bullhorn fa-3x mb-3" style="opacity:0.3"></i>
    <p>Belum ada pengumuman</p>
</div>
@endforelse
@endsection