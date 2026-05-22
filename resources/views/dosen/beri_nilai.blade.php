@extends('layouts.admin')

@section('title', 'Beri Nilai Tugas')
@section('content')
<div class="card">
    <div class="card-header">
        <h5>Beri Nilai Tugas</h5>
    </div>
    <div class="card-body">
        <p><strong>Tugas:</strong> {{ $penilaian->tugas->judul_tugas }}</p>
        <p><strong>Mahasiswa:</strong> {{ $penilaian->mahasiswa->nim }} - {{ $penilaian->mahasiswa->nama }}</p>

        @if($penilaian->upload_file)
            <p>
                <strong>File Jawaban:</strong>
                <a href="{{ Storage::url($penilaian->upload_file) }}" target="_blank" class="btn btn-sm btn-info">Lihat / Download File</a>
            </p>
        @endif

        <form method="POST" action="{{ route('dosen.nilai.store') }}">
            @csrf
            {{-- FIX: pakai id_nilai sesuai primary key model Penilaian --}}
            <input type="hidden" name="id_nilai" value="{{ $penilaian->id_nilai }}">
            <div class="form-group mb-3">
                <label><strong>Nilai (0-100)</strong></label>
                <input type="number" name="nilai" step="0.01" min="0" max="100"
                    class="form-control" style="max-width: 200px;"
                    value="{{ $penilaian->nilai }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Nilai</button>
            <a href="{{ route('dosen.kelas.detail', $penilaian->tugas->materi->id_kelas) }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection