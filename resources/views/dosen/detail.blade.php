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
        <div class="mt-3">
            <a href="{{ route('dosen.materi.page') }}" class="btn btn-primary me-2">
                <i class="fas fa-file-alt me-1"></i> Lihat Materi
            </a>
            <a href="{{ route('dosen.tugas.page') }}" class="btn btn-warning me-2">
                <i class="fas fa-tasks me-1"></i> Lihat Tugas
            </a>
            <a href="{{ route('dosen.pengumuman', $id_kelas) }}" class="btn btn-info me-2">
                <i class="fas fa-bullhorn me-1"></i> Pengumuman
            </a>
            <a href="{{ route('dosen.jadwal') }}" class="btn btn-success">
                <i class="fas fa-calendar-alt me-1"></i> Jadwal
            </a>
        </div>
    </div>
</div>

{{-- Nilai Akhir Mahasiswa --}}
<div class="card mt-4">
    <div class="card-header"><h5 class="mb-0">Nilai Akhir Mahasiswa</h5></div>
    <div class="card-body">
        <div style="overflow-x:auto;">
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
</div>
@endsection