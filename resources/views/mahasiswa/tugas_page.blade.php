@extends('layouts.admin')

@section('title', 'Tugas Perkuliahan')
@section('active_tugas', 'active')

@section('content')
<h4 class="mb-4 section-title"><i class="fas fa-tasks me-2"></i>Tugas Perkuliahan</h4>

@forelse($kelas_list as $kelas)
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-school me-2"></i>{{ $kelas->mataKuliah->nama_matkul }} - {{ $kelas->nama_kelas }}</h5>
    </div>
    <div class="card-body">
        <div style="overflow-x:auto;">
            <table class="table table-striped">
                <thead>
                    <tr><th>Judul</th><th>Deskripsi</th><th>Deadline</th><th>File Soal</th><th>Status</th><th>Upload Jawaban</th><th>Nilai</th></tr>
                </thead>
                <tbody>
                    @forelse($kelas->tugas_list as $t)
                    @php $penilaian = $t->penilaian->first(); @endphp
                    <tr>
                        <td>{{ $t->judul_tugas }}</td>
                        <td>{{ $t->deskripsi_tugas ?? '-' }}</td>
                        <td>{{ $t->deadline->format('d/m/Y H:i') }}</td>
                        <td>
                            @if($t->file_tugas)
                                <a href="{{ route('download.file', $t->file_tugas) }}" class="btn btn-sm btn-info">Lihat Soal</a>
                            @else -
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $penilaian && $penilaian->status == 'diserahkan' ? 'bg-success' : 'bg-warning' }}">
                                {{ $penilaian && $penilaian->status == 'diserahkan' ? 'Diserahkan' : 'Belum' }}
                            </span>
                        </td>
                        <td>
                            @if($penilaian && $penilaian->upload_file)
                                <a href="{{ route('download.tugas', basename($penilaian->upload_file)) }}" class="btn btn-sm btn-success">Lihat File</a>
                                <form method="POST" action="{{ route('mahasiswa.tugas.submit') }}" enctype="multipart/form-data" class="mt-1">
                                    @csrf
                                    <input type="hidden" name="id_tugas" value="{{ $t->id_tugas }}">
                                    <input type="hidden" name="id_kelas" value="{{ $kelas->id_kelas }}">
                                    <div class="input-group input-group-sm">
                                        <input type="file" name="upload_file" class="form-control form-control-sm" required>
                                        <button type="submit" class="btn btn-sm btn-warning">Ubah</button>
                                    </div>
                                </form>
                            @else
                                <form method="POST" action="{{ route('mahasiswa.tugas.submit') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id_tugas" value="{{ $t->id_tugas }}">
                                    <input type="hidden" name="id_kelas" value="{{ $kelas->id_kelas }}">
                                    <div class="input-group input-group-sm">
                                        <input type="file" name="upload_file" class="form-control form-control-sm" required>
                                        <button type="submit" class="btn btn-sm btn-info">Upload</button>
                                    </div>
                                </form>
                            @endif
                        </td>
                        <td>{{ $penilaian && $penilaian->nilai ? $penilaian->nilai : '-' }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center">Belum ada tugas</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@empty
<div class="card p-4 text-center text-muted">
    <i class="fas fa-tasks fa-3x mb-3" style="opacity:0.3"></i>
    <p>Belum ada kelas yang diikuti</p>
</div>
@endforelse
@endsection