@extends('layouts.admin')

@section('title', 'Materi Perkuliahan')
@section('active_materi', 'active')

@section('content')
<h4 class="mb-4 section-title"><i class="fas fa-file-alt me-2"></i>Materi Perkuliahan</h4>

@forelse($kelas_list as $kelas)
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-school me-2"></i>{{ $kelas->mataKuliah->nama_matkul }} - {{ $kelas->nama_kelas }}</h5>
    </div>
    <div class="card-body">
        <div style="overflow-x:auto;">
            <table class="table table-striped">
                <thead>
                    <tr><th>Judul</th><th>Deskripsi</th><th>File</th></tr>
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
                    </tr>
                    @empty
                    <tr><td colspan="3" class="text-center">Belum ada materi</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@empty
<div class="card p-4 text-center text-muted">
    <i class="fas fa-file-alt fa-3x mb-3" style="opacity:0.3"></i>
    <p>Belum ada kelas yang diikuti</p>
</div>
@endforelse
@endsection