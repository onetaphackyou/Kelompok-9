@extends('layouts.admin')

@section('title', 'Pengumuman')
@section('active_kelas', 'active')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-bullhorn me-2"></i>Pengumuman - {{ $kelas->mataKuliah->nama_matkul }} ({{ $kelas->nama_kelas }})</h5>
        <a href="{{ route('mahasiswa.kelas.detail', $id_kelas) }}" class="btn btn-secondary btn-sm">Kembali</a>
    </div>
    <div class="card-body">
        @forelse($pengumuman as $p)
        <div class="card mb-3" style="border-left: 4px solid #0d6efd;">
            <div class="card-body">
                <h6 class="fw-bold mb-1">{{ $p->judul }}</h6>
                <p class="mb-1">{{ $p->isi }}</p>
                <small class="text-muted">
                    <i class="fas fa-user me-1"></i>{{ $p->dosen->nama ?? 'Dosen' }}
                    &nbsp;|&nbsp;
                    <i class="fas fa-clock me-1"></i>{{ $p->created_at->diffForHumans() }}
                </small>
            </div>
        </div>
        @empty
        <div class="text-center text-muted py-4">
            <i class="fas fa-bullhorn fa-3x mb-3" style="opacity:0.3"></i>
            <p>Belum ada pengumuman</p>
        </div>
        @endforelse
    </div>
</div>
@endsection