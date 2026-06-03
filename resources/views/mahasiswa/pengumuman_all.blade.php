@extends('layouts.admin')

@section('title', 'Pengumuman')
@section('active_pengumuman', 'active')

@section('content')
<h4 class="mb-4 section-title"><i class="fas fa-bullhorn me-2"></i>Pengumuman</h4>

@forelse($pengumuman_list as $p)
<div class="card mb-3" style="border-left: 4px solid #0d6efd;">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <span class="badge bg-primary mb-2">{{ $p->kelas->mataKuliah->nama_matkul }}</span>
                <h6 class="fw-bold mb-1">{{ $p->judul }}</h6>
                <p class="mb-1">{{ $p->isi }}</p>
                <small class="text-muted">
                    <i class="fas fa-user me-1"></i>{{ $p->dosen->nama ?? 'Dosen' }}
                    &nbsp;|&nbsp;
                    <i class="fas fa-clock me-1"></i>{{ $p->created_at->diffForHumans() }}
                </small>
            </div>
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