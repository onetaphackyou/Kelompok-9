{{-- resources/views/admin_prodi/detail.blade.php --}}
@extends('layouts.admin')

@section('title', 'Detail Kelas')
@section('active_kelas', 'active')

@section('content')
<h2 class="section-title">Detail Kelas</h2>

<div class="card shadow-sm p-4 mb-4">
    <h5>Informasi Kelas</h5>
    <p><strong>Nama Kelas:</strong> {{ $kelas_info->nama_kelas }}</p>
    <p><strong>Mata Kuliah:</strong> {{ $kelas_info->mataKuliah->nama_matkul ?? '-' }}</p>
    <p><strong>Dosen:</strong> {{ $kelas_info->dosen->nama ?? '-' }}</p>
    <p><strong>Hari / Waktu:</strong> {{ $kelas_info->hari }} / {{ $kelas_info->jam_awal }} - {{ $kelas_info->jam_akhir }}</p>
    <p><strong>Ruangan:</strong> {{ $kelas_info->ruangan }}</p>
    <p><strong>Periode:</strong> {{ $kelas_info->periode }}</p>
    <p><strong>Total Peserta:</strong> {{ $total_peserta }}</p>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card shadow-sm p-4">
            <h5>Materi</h5>
            @if($materi_list->isEmpty())
                <p>Tidak ada materi untuk kelas ini.</p>
            @else
                <ul class="list-group list-group-flush">
                    @foreach($materi_list as $materi)
                        <li class="list-group-item">
                            <strong>{{ $materi->judul_materi }}</strong>
                            <p class="mb-1">{{ $materi->deskripsi ?? '-' }}</p>
                            <small>{{ $materi->tugas_count }} tugas terkait</small>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-sm p-4">
            <h5>Tugas</h5>
            @if($tugas_list->isEmpty())
                <p>Tidak ada tugas untuk kelas ini.</p>
            @else
                <ul class="list-group list-group-flush">
                    @foreach($tugas_list as $tugas)
                        <li class="list-group-item">
                            <strong>{{ $tugas->judul_tugas }}</strong>
                            <p class="mb-1">{{ $tugas->deskripsi_tugas ?? '-' }}</p>
                            <small>Deadline: {{ optional($tugas->deadline)->format('d M Y H:i') ?? '-' }}</small>
                            <div class="mt-2">
                                <span class="badge bg-secondary">Diserahkan: {{ $tugas->jumlah_diserahkan }}</span>
                                <span class="badge bg-success">Dinilai: {{ $tugas->jumlah_dinilai }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('admin_prodi.kelas') }}" class="btn btn-secondary">Kembali ke Daftar Kelas</a>
</div>
@endsection
