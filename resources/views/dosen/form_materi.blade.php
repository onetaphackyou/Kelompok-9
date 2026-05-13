@extends('layouts.admin')

@section('title', isset($materi) ? 'Edit Materi' : 'Tambah Materi')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>{{ isset($materi) ? 'Edit Materi' : 'Tambah Materi Baru' }}</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ isset($materi) ? route('dosen.materi.update', $materi->id_materi) : route('dosen.materi.store') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($materi)) @method('PUT') @endif

            <input type="hidden" name="id_kelas" value="{{ $kelas->id_kelas ?? $materi->id_kelas }}">

            <div class="mb-3">
                <label for="judul_materi" class="form-label">Judul Materi</label>
                <input type="text" class="form-control" name="judul_materi" value="{{ old('judul_materi', $materi->judul_materi ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" rows="4">{{ old('deskripsi', $materi->deskripsi ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="upload_file" class="form-label">File Materi (Opsional)</label>
                <input type="file" class="form-control" name="upload_file">
                @if(isset($materi) && $materi->upload_file)
                    <small class="text-muted">File saat ini: {{ basename($materi->upload_file) }}</small>
                @endif
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('dosen.kelas.detail', $kelas->id_kelas ?? $materi->id_kelas) }}" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
