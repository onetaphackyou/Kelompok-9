@extends('layouts.admin')

@section('title', 'Detail Kelas')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between"><h5>Detail Kelas</h5><a href="{{ route('mahasiswa.kelas') }}" class="btn btn-secondary btn-sm">Kembali</a></div>
    <div class="card-body">
        <div class="row"><div class="col-md-6"><p><strong>Mata Kuliah:</strong> {{ $kelas->mataKuliah->nama_matkul }}</p><p><strong>Kelas:</strong> {{ $kelas->nama_kelas }}</p><p><strong>Dosen:</strong> {{ $kelas->dosen->nama }}</p></div><div class="col-md-6"><p><strong>Hari:</strong> {{ $kelas->hari }}</p><p><strong>Jam:</strong> {{ $kelas->jam_awal }} - {{ $kelas->jam_akhir }}</p><p><strong>Ruangan:</strong> {{ $kelas->ruangan }}</p><p><strong>Periode:</strong> {{ $kelas->periode }}</p></div></div>
    </div>
</div>

<!-- MATERI -->
<div class="card mt-4"><div class="card-header"><h5>Materi Perkuliahan</h5></div><div class="card-body"><table class="table table-striped"><thead><tr><th>Judul</th><th>Deskripsi</th><th>File</th></tr></thead><tbody>@foreach($materi_list as $m)<tr><td>{{ $m->judul_materi }}</td><td>{{ $m->deskripsi ?? '-' }}</td><td>@if($m->upload_file)<a href="{{ Storage::url($m->upload_file) }}" download class="btn btn-sm btn-primary">Download</a>@else - @endif</td></tr>@endforeach</tbody></table></div></div>

<!-- TUGAS -->
<div class="card mt-4"><div class="card-header"><h5>Tugas Perkuliahan</h5></div><div class="card-body"><table class="table table-striped"><thead><tr><th>Judul</th><th>Deskripsi</th><th>Deadline</th><th>Status</th><th>File</th><th>Nilai</th></tr></thead><tbody>
@foreach($tugas_list as $t)
@php $penilaian = $t->penilaian->first(); @endphp
<tr>
    <td>{{ $t->judul_tugas }}</td>
    <td>{{ $t->deskripsi_tugas ?? '-' }}</td>
    <td>{{ $t->deadline->format('d/m/Y H:i') }}</td>
    <td><span class="badge {{ $penilaian && $penilaian->status == 'diserahkan' ? 'bg-success' : 'bg-warning' }}">{{ $penilaian && $penilaian->status == 'diserahkan' ? 'Diserahkan' : 'Belum Diserahkan' }}</span></td>
    <td>
        @if($penilaian && $penilaian->upload_file)
            <a href="{{ Storage::url($penilaian->upload_file) }}" download class="btn btn-sm btn-primary">Download</a>
            <form method="POST" action="{{ route('mahasiswa.tugas.submit') }}" enctype="multipart/form-data" style="display:inline-block; margin-left:8px;">
                @csrf
                <input type="hidden" name="id_tugas" value="{{ $t->id_tugas }}">
                <input type="hidden" name="id_kelas" value="{{ $kelas->id_kelas }}">
                <input type="file" name="upload_file" required style="display:inline-block;">
                <button type="submit" class="btn btn-sm btn-info">Ubah Unggahan</button>
            </form>
        @else
            <form method="POST" action="{{ route('mahasiswa.tugas.submit') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_tugas" value="{{ $t->id_tugas }}">
                <input type="hidden" name="id_kelas" value="{{ $kelas->id_kelas }}">
                <input type="file" name="upload_file" required>
                <button type="submit" class="btn btn-sm btn-info">Upload</button>
            </form>
        @endif
    </td>
    <td>{{ $penilaian && $penilaian->nilai ? $penilaian->nilai : '-' }}</td>
</tr>
@endforeach
</tbody></table></div></div>

<!-- NILAI PERKULIAHAN -->
<div class="card mt-4"><div class="card-header"><h5>Nilai Perkuliahan</h5></div><div class="card-body"><table class="table table-striped"><thead><tr><th>Mata Kuliah</th><th>Nilai Akhir</th></tr></thead><tbody><tr><td>{{ $kelas->mataKuliah->nama_matkul }}</td><td>{{ $kelas->peserta->where('id_mhs', Auth::user()->mahasiswa->id_mhs)->first()->nilai_akhir ?? '-' }}</td></tr></tbody></table></div></div>
@endsection
