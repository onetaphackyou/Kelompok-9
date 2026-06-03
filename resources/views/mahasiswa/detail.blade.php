@extends('layouts.admin')

@section('title', 'Detail Perkuliahan')
@section('active_kelas', 'active')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Detail Perkuliahan</h5>
        <a href="{{ route('mahasiswa.kelas') }}" class="btn btn-secondary btn-sm">Kembali</a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Mata Kuliah:</strong> {{ $kelas->mataKuliah->nama_matkul }}</p>
                <p><strong>Kelas:</strong> {{ $kelas->nama_kelas }}</p>
                <p><strong>Dosen:</strong> {{ $kelas->dosen->nama }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Hari:</strong> {{ $kelas->hari }}</p>
                <p><strong>Jam:</strong> {{ $kelas->jam_awal }} - {{ $kelas->jam_akhir }}</p>
                <p><strong>Ruangan:</strong> {{ $kelas->ruangan }}</p>
                <p><strong>Periode:</strong> {{ $kelas->periode }}</p>
            </div>
        </div>
        <div class="mt-3">
            <a href="{{ route('mahasiswa.materi') }}" class="btn btn-primary me-2">
                <i class="fas fa-file-alt me-1"></i> Lihat Materi
            </a>
            <a href="{{ route('mahasiswa.tugas') }}" class="btn btn-warning me-2">
                <i class="fas fa-tasks me-1"></i> Lihat Tugas
            </a>
            <a href="{{ route('mahasiswa.pengumuman.all') }}" class="btn btn-info me-2">
                <i class="fas fa-bullhorn me-1"></i> Pengumuman
            </a>
            <a href="{{ route('mahasiswa.jadwal') }}" class="btn btn-success me-2">
                <i class="fas fa-calendar-alt me-1"></i> Jadwal
            </a>
            <a href="{{ route('mahasiswa.nilai') }}" class="btn btn-danger">
                <i class="fas fa-star me-1"></i> Nilai
            </a>
        </div>
    </div>
</div>
@endsection