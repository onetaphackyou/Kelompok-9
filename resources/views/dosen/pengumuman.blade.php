@extends('layouts.admin')

@section('title', 'Pengumuman')
@section('active_kelas', 'active')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-bullhorn me-2"></i>Pengumuman - {{ $kelas->mataKuliah->nama_matkul }} ({{ $kelas->nama_kelas }})</h5>
        <a href="{{ route('dosen.kelas.detail', $id_kelas) }}" class="btn btn-secondary btn-sm">Kembali</a>
    </div>
    <div class="card-body">
        {{-- Form Tambah Pengumuman --}}
        <form action="{{ route('dosen.pengumuman.store') }}" method="POST" class="mb-4">
            @csrf
            <input type="hidden" name="id_kelas" value="{{ $id_kelas }}">
            <div class="mb-3">
                <input type="text" name="judul" class="form-control" placeholder="Judul Pengumuman" required>
            </div>
            <div class="mb-3">
                <textarea name="isi" class="form-control" rows="3" placeholder="Isi Pengumuman..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane me-1"></i> Kirim Pengumuman
            </button>
        </form>

        <hr>

        {{-- Daftar Pengumuman --}}
        @forelse($pengumuman as $p)
        <div class="card mb-3" style="border-left: 4px solid #0d6efd;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="fw-bold mb-1">{{ $p->judul }}</h6>
                        <p class="mb-1">{{ $p->isi }}</p>
                        <small class="text-muted"><i class="fas fa-clock me-1"></i>{{ $p->created_at->diffForHumans() }}</small>
                    </div>
                    <form action="{{ route('dosen.pengumuman.hapus', $p->id_pengumuman) }}" method="POST" onsubmit="return confirm('Hapus pengumuman?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
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