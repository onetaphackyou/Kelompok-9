@extends('layouts.admin')

@section('title', isset($tugas) ? 'Edit Tugas' : 'Tambah Tugas')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>{{ isset($tugas) ? 'Edit Tugas' : 'Tambah Tugas Baru' }}</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ isset($tugas) ? route('dosen.tugas.update', $tugas->id_tugas) : route('dosen.tugas.store') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($tugas)) @method('PUT') @endif

            <div class="mb-3">
                <label for="id_materi" class="form-label">Materi Terkait</label>
                <select class="form-select" name="id_materi" required>
                    <option value="">Pilih Materi</option>
                    @foreach($materi_list as $materi)
                        <option value="{{ $materi->id_materi }}" {{ (isset($tugas) && $tugas->id_materi == $materi->id_materi) ? 'selected' : '' }}>
                            {{ $materi->judul_materi }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="judul_tugas" class="form-label">Judul Tugas</label>
                <input type="text" class="form-control" name="judul_tugas" value="{{ old('judul_tugas', $tugas->judul_tugas ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi_tugas" class="form-label">Deskripsi Tugas</label>
                <textarea class="form-control" name="deskripsi_tugas" rows="4" required>{{ old('deskripsi_tugas', $tugas->deskripsi_tugas ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="deadline" class="form-label">Deadline</label>
                <input type="datetime-local" class="form-control" name="deadline" value="{{ isset($tugas) ? $tugas->deadline->format('Y-m-d\TH:i') : '' }}" required>
            </div>

            <div class="mb-3">
                <label for="file_tugas" class="form-label">File Tugas (Opsional)</label>
                <input type="file" class="form-control" name="file_tugas">
                @if(isset($tugas) && $tugas->file_tugas)
                    <small class="text-muted">File saat ini: {{ basename($tugas->file_tugas) }}</small>
                @endif
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('dosen.kelas.detail', $kelas->id_kelas ?? $tugas->materi->id_kelas) }}" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
