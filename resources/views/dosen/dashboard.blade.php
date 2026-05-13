@extends('layouts.admin')

@section('title', 'Dashboard Dosen')
@section('active_dashboard', 'active')

@section('content')
<h4 class="mb-4 section-title">Dashboard Dosen</h4>
<div class="row g-3">
    <div class="col-md-2">
        <div class="card card-stat text-center p-3">
            <h3>{{ $kelas_count }}</h3>
            <p>Total Kelas</p>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card card-stat text-center p-3">
            <h3>{{ $mhs_count }}</h3>
            <p>Total Mahasiswa</p>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card card-stat text-center p-3">
            <h3>{{ $materi_count }}</h3>
            <p>Total Materi</p>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card card-stat text-center p-3">
            <h3>{{ $tugas_count }}</h3>
            <p>Total Tugas</p>
        </div>
    </div>
</div>
@endsection
