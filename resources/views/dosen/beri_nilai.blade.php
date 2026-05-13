@extends('layouts.admin')

@section('title', 'Beri Nilai Tugas')
@section('content')
<h2>Beri Nilai Tugas</h2>
<p>Tugas: {{ $penilaian->tugas->judul_tugas }}</p>
<p>Mahasiswa: {{ $penilaian->mahasiswa->nim }} - {{ $penilaian->mahasiswa->nama }}</p>
<form method="POST" action="{{ route('dosen.nilai.store') }}">
    @csrf
    <input type="hidden" name="id_penilaian" value="{{ $penilaian->id_nilai }}">
    <div class="form-group">
        <label>Nilai (0-100)</label>
        <input type="number" name="nilai" step="0.01" min="0" max="100" class="form-control" value="{{ $penilaian->nilai }}">
    </div>
    <button type="submit" class="btn btn-primary">Simpan Nilai</button>
    <a href="{{ route('dosen.kelas.detail', $penilaian->tugas->materi->id_kelas) }}" class="btn btn-secondary">Batal</a>
</form>
@endsection
