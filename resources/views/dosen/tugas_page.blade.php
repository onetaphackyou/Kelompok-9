@extends('layouts.admin')

@section('title', 'Tugas Perkuliahan')
@section('active_tugas', 'active')

@section('content')
<h4 class="mb-4 section-title"><i class="fas fa-tasks me-2"></i>Tugas Perkuliahan</h4>

@forelse($kelas_list as $kelas)
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-school me-2"></i>{{ $kelas->mataKuliah->nama_matkul }} - {{ $kelas->nama_kelas }}</h5>
        <a href="{{ route('dosen.kelas.detail', $kelas->id_kelas) }}" class="btn btn-sm btn-primary">+ Tambah Tugas</a>
    </div>
    <div class="card-body">
        <div style="overflow-x:auto;">
            <table class="table table-striped">
                <thead>
                    <tr><th>Judul</th><th>Deskripsi</th><th>Deadline</th><th>File Soal</th><th>Pengumpulan</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($kelas->tugas_list as $t)
                    <tr>
                        <td>{{ $t->judul_tugas }}</td>
                        <td>{{ $t->deskripsi_tugas ?? '-' }}</td>
                        <td>{{ $t->deadline->format('d/m/Y H:i') }}</td>
                        <td>
                            @if($t->file_tugas)
                                <a href="{{ route('download.file', $t->file_tugas) }}" class="btn btn-sm btn-primary">Lihat Soal</a>
                            @else -
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('dosen.pengumpulan', [$t->id_tugas, $kelas->id_kelas]) }}" class="btn btn-sm btn-info">
                                Lihat Pengumpulan ({{ $t->penilaian->count() }})
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('dosen.tugas.hapus', $t->id_tugas) }}" method="POST" onsubmit="return confirm('Hapus tugas?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center">Belum ada tugas</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@empty
<div class="card p-4 text-center text-muted">
    <i class="fas fa-tasks fa-3x mb-3" style="opacity:0.3"></i>
    <p>Belum ada kelas yang diampu</p>
</div>
@endforelse
@endsection