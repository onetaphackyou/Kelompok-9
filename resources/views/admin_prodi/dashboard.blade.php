{{-- resources/views/admin_prodi/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title', 'Dashboard')
@section('active_dashboard', 'active')

@section('content')
<h4 class="mb-4 section-title">Dashboard Admin Prodi</h4>

<div class="row g-3">
    <div class="col-md-2">
        <div class="card card-stat text-center p-3">
            <h3>{{ $total_mhs }}</h3>
            <p>Mahasiswa</p>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card card-stat text-center p-3">
            <h3>{{ $total_dosen }}</h3>
            <p>Dosen</p>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card card-stat text-center p-3">
            <h3>{{ $total_matkul }}</h3>
            <p>Mata Kuliah</p>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card card-stat text-center p-3">
            <h3>{{ $total_kelas }}</h3>
            <p>Kelas</p>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card card-stat text-center p-3">
            <h3>{{ $total_peserta }}</h3>
            <p>Peserta</p>
        </div>
    </div>
</div>
@endsection
