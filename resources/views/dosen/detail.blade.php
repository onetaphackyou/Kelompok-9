@extends('layouts.admin')

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
    <div class="card-header">
        <h5 class="mb-2">Materi Perkuliahan</h5>
        {{-- FIX MASALAH 2: tambahkan field deskripsi di form --}}
        <form action="{{ route('dosen.materi.tambah') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id_kelas" value="{{ $id_kelas }}">
            <div class="row g-2">
                <div class="col-md-3">
                    <input type="text" name="judul_materi" placeholder="Judul Materi" class="form-control form-control-sm" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="deskripsi" placeholder="Deskripsi / Info tambahan" class="form-control form-control-sm">
                </div>
                <div class="col-md-3">
                    <input type="file" name="upload_file" class="form-control form-control-sm">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success btn-sm w-100">+ Tambah Materi</button>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr><th>Judul</th><th>Deskripsi</th><th>File</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($materi_list as $m)
                <tr>
                    <td>{{ $m->judul_materi }}</td>
                    <td>{{ $m->deskripsi ?? '-' }}</td>
                    {{-- FIX MASALAH 1: file disimpan di public/uploads, pakai asset() bukan Storage::url() --}}
                    <td>
                        @if($m->upload_file)
                            <a href="{{ asset('uploads/' . $m->upload_file) }}" target="_blank" class="btn btn-sm btn-primary">Download</a>
                        @else
                            -
                        @endif
                    </td>
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
        <h5 class="mb-2">Tugas Perkuliahan</h5>
        <form action="{{ route('dosen.tugas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id_kelas" value="{{ $id_kelas }}">
            <div class="row g-2">
                <div class="col-md-2">
                    <select name="id_materi" class="form-select form-select-sm" required>
                        <option value="">-- Pilih Materi --</option>
                        @foreach($materi_list as $m)
                        <option value="{{ $m->id_materi }}">{{ $m->judul_materi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="text" name="judul_tugas" placeholder="Judul Tugas" class="form-control form-control-sm" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="deskripsi_tugas" placeholder="Deskripsi Tugas" class="form-control form-control-sm">
                </div>
                <div class="col-md-2">
                    <input type="datetime-local" name="deadline" class="form-control form-control-sm" required>
                </div>
                <div class="col-md-2">
                    <input type="file" name="file_tugas" class="form-control form-control-sm">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-success btn-sm w-100">+ Tambah</button>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr><th>Judul Tugas</th><th>Deskripsi</th><th>Deadline</th><th>File Soal</th><th>Pengumpulan</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($tugas_list as $t)
                <tr>
                    <td>{{ $t->judul_tugas }}</td>
                    <td>{{ $t->deskripsi_tugas ?? '-' }}</td>
                    <td>{{ $t->deadline->format('d/m/Y H:i') }}</td>
                    {{-- FIX MASALAH 4: file tugas dosen juga pakai asset() --}}
                    <td>
                        @if($t->file_tugas)
                            <a href="{{ asset('uploads/' . $t->file_tugas) }}" target="_blank" class="btn btn-sm btn-primary">Download</a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('dosen.pengumpulan', [$t->id_tugas, $id_kelas]) }}" class="btn btn-sm btn-info">
                            Lihat Pengumpulan ({{ $t->jumlah_pengumpulan ?? 0 }})
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
                <tr><td colspan="6" class="text-center">Belum ada tugas perkuliahan</td></tr>
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
            <thead><tr><th>NIM</th><th>Nama</th><th>Nilai Akhir</th><th>Aksi</th></tr></thead>
            <tbody>
                @forelse($nilai_akhir as $n)
                <tr>
                    <td>{{ $n->mahasiswa->nim }}</td>
                    <td>{{ $n->mahasiswa->nama }}</td>
                    <td>{{ $n->nilai_akhir ?? '-' }}</td>
                    <td>
                        <form action="{{ route('dosen.nilai.final.store', [$id_kelas, $n->mahasiswa->id_mhs]) }}" method="POST" class="d-inline">
                            @csrf
                            <div class="input-group input-group-sm" style="width: 180px;">
                                <input type="number" name="nilai_akhir" class="form-control form-control-sm" min="0" max="100" value="{{ $n->nilai_akhir ?? '' }}" placeholder="0-100">
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            </div>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center">Tidak ada data mahasiswa</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection