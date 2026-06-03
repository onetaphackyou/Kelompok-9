@extends('layouts.admin')

@section('title', 'Materi Perkuliahan')
@section('active_materi', 'active')

@section('content')
<h4 class="mb-4 section-title"><i class="fas fa-file-alt me-2"></i>Materi Perkuliahan</h4>

@forelse($kelas_list as $kelas)
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-school me-2"></i>{{ $kelas->mataKuliah->nama_matkul }} - {{ $kelas->nama_kelas }}</h5>
        <a href="{{ route('dosen.kelas.detail', $kelas->id_kelas) }}" class="btn btn-sm btn-primary">+ Tambah Materi</a>
    </div>
    <div class="card-body">
        <div style="overflow-x:auto;">
            <table class="table table-striped">
                <thead>
                    <tr><th>Judul</th><th>Deskripsi</th><th>File</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($kelas->materi as $m)
                    <tr>
                        <td>{{ $m->judul_materi }}</td>
                        <td>{{ $m->deskripsi ?? '-' }}</td>
                        <td>
                            @if($m->upload_file)
                                <a href="{{ route('download.file', $m->upload_file) }}" class="btn btn-sm btn-primary">Lihat Materi</a>
                            @else -
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('dosen.materi.hapus', $m->id_materi) }}" method="POST" onsubmit="return confirm('Hapus materi?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center">Belum ada materi</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@empty
<div class="card p-4 text-center text-muted">
    <i class="fas fa-file-alt fa-3x mb-3" style="opacity:0.3"></i>
    <p>Belum ada kelas yang diampu</p>
</div>
@endforelse
@endsection