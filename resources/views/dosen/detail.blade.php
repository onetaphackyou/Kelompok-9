@extends('layouts.app')

@section('title', 'Detail Kelas')
@section('active_kelas', 'active')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Detail Kelas</h5>
        <a href="{{ route('dosen.kelas') }}" class="btn btn-secondary btn-sm">Kembali</a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Mata Kuliah:</strong> {{ $kelas_info->mataKuliah->nama_matkul }}</p>
                <p><strong>Kelas:</strong> {{ $kelas_info->nama_kelas }}</p>
                <p><strong>Hari:</strong> {{ $kelas_info->hari }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Jam:</strong> {{ $kelas_info->jam_awal }} - {{ $kelas_info->jam_akhir }}</p>
                <p><strong>Ruangan:</strong> {{ $kelas_info->ruangan }}</p>
                <p><strong>Periode:</strong> {{ $kelas_info->periode }}</p>
            </div>
        </div>
    </div>
</div>

{{-- Materi --}}
<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h5 class="mb-0">Materi Perkuliahan</h5>
        <form action="{{ route('dosen.materi.tambah') }}" method="POST" enctype="multipart/form-data" class="d-inline w-100">
            @csrf
            <input type="hidden" name="id_kelas" value="{{ $id_kelas }}">
            <div class="input-group input-group-sm">
                <input type="text" name="judul_materi" placeholder="Judul" class="form-control form-control-sm" required>
                <input type="file" name="upload_file" class="form-control form-control-sm">
                <button type="submit" class="btn btn-success btn-sm">+ Tambah Materi</button>
            </div>
        </form>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead><tr><th>Judul</th><th>Deskripsi</th><th>File</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($materi_list as $m)
                <tr>
                    <td>{{ $m->judul_materi }}</td>
                    <td>{{ $m->deskripsi ?? '-' }}</td>
                    <td>@if($m->upload_file) <a href="{{ asset('uploads/'.$m->upload_file) }}" download>Download</a> @else - @endif</td>
                    <td>
                        <form action="{{ route('dosen.materi.hapus', $m->id_materi) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Hapus materi?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center">Belum ada materi perkuliahan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Tugas --}}
<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">Tugas Perkuliahan</h5>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead><tr><th>Judul Tugas</th><th>Deadline</th><th>File</th><th>Pengumpulan</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($tugas_list as $t)
                <tr>
                    <td>{{ $t->judul_tugas }}</td>
                    <td>{{ $t->deadline->format('d/m/Y H:i') }}</td>
                    <td>@if($t->file_tugas) <a href="{{ asset('uploads/'.$t->file_tugas) }}" download>Download</a> @else - @endif</td>
                    <td><a href="{{ route('dosen.pengumpulan', [$t->id_tugas, $id_kelas]) }}" class="btn btn-sm btn-info">Lihat Pengumpulan ({{ $t->jumlah_pengumpulan ?? 0 }})</a></td>
                    <td>
                        <form action="{{ route('dosen.tugas.hapus', $t->id_tugas) }}" method="POST" onsubmit="return confirm('Hapus tugas?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center">Belum ada tugas perkuliahan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Nilai Akhir --}}
<div class="card mt-4">
    <div class="card-header"><h5 class="mb-0">Nilai Akhir Mahasiswa</h5></div>
    <div class="card-body">
        <table class="table table-striped">
            <thead><tr><th>NIM</th><th>Nama</th><th>Nilai Akhir</th></tr></thead>
            <tbody>
                @forelse($nilai_akhir as $n)
                <tr>
                    <td>{{ $n->mahasiswa->nim }}</td>
                    <td>{{ $n->mahasiswa->nama }}</td>
                    <td>{{ $n->nilai_akhir ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center">Tidak ada data mahasiswa</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
