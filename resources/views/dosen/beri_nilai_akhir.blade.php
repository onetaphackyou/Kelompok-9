@extends('layouts.app')

@section('title', 'Beri Nilai Akhir')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Beri Nilai Akhir</h5>
    </div>
    <div class="card-body">
        <p><strong>Mahasiswa:</strong> {{ $mahasiswa->nama }} ({{ $mahasiswa->nim }})</p>
        <p><strong>Kelas:</strong> {{ $kelas->mataKuliah->nama_matkul }} - {{ $kelas->nama_kelas }}</p>

        <form method="POST" action="{{ route('dosen.nilai.final.store', [$kelas->id_kelas, $mahasiswa->id_mhs]) }}">
            @csrf
            <div class="mb-3">
                <label for="nilai_akhir" class="form-label">Nilai Akhir</label>
                <input type="text" class="form-control" id="nilai_akhir" name="nilai_akhir"
                       value="{{ $peserta->nilai_akhir ?? '' }}"
                       placeholder="Contoh: A, B+, 85, dll" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Nilai Akhir</button>
            <a href="{{ route('dosen.kelas.detail', $kelas->id_kelas) }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
