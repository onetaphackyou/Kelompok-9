@extends('layouts.admin')

@section('title', 'Dashboard Admin Prodi')
@section('active_dashboard', 'active')

@section('content')
<h4 class="mb-4 section-title">Dashboard Admin Prodi</h4>

{{-- Baris 1: Statistik Cards --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-4">
        <div class="card card-stat text-center p-3">
            <i class="fas fa-user-graduate fa-2x mb-2" style="opacity:0.8"></i>
            <h3>{{ $total_mhs }}</h3>
            <p>Mahasiswa</p>
        </div>
    </div>
    <div class="col-6 col-md-4">
        <div class="card card-stat text-center p-3">
            <i class="fas fa-chalkboard-teacher fa-2x mb-2" style="opacity:0.8"></i>
            <h3>{{ $total_dosen }}</h3>
            <p>Dosen</p>
        </div>
    </div>
    <div class="col-6 col-md-4">
        <div class="card card-stat text-center p-3">
            <i class="fas fa-book fa-2x mb-2" style="opacity:0.8"></i>
            <h3>{{ $total_matkul }}</h3>
            <p>Mata Kuliah</p>
        </div>
    </div>
    <div class="col-6 col-md-6">
        <div class="card card-stat text-center p-3">
            <i class="fas fa-school fa-2x mb-2" style="opacity:0.8"></i>
            <h3>{{ $total_kelas }}</h3>
            <p>Kelas</p>
        </div>
    </div>
    <div class="col-6 col-md-6">
        <div class="card card-stat text-center p-3">
            <i class="fas fa-users fa-2x mb-2" style="opacity:0.8"></i>
            <h3>{{ $total_peserta }}</h3>
            <p>Peserta</p>
        </div>
    </div>
</div>

{{-- Grafik --}}
<div class="row g-3">
    <div class="col-md-6">
        <div class="card p-3" style="height: 320px;">
            <h6 class="mb-3"><i class="fas fa-chart-bar me-2"></i>Statistik Prodi</h6>
            <div style="position:relative; height:240px;">
                <canvas id="chartProdi"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card p-3" style="height: 320px;">
            <h6 class="mb-3"><i class="fas fa-chart-pie me-2"></i>Distribusi Data</h6>
            <div style="position:relative; height:240px;">
                <canvas id="chartDistribusi"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(document.getElementById('chartProdi'), {
        type: 'bar',
        data: {
            labels: ['Mahasiswa', 'Dosen', 'Mata Kuliah', 'Kelas', 'Peserta'],
            datasets: [{
                label: 'Jumlah',
                data: [{{ $total_mhs }}, {{ $total_dosen }}, {{ $total_matkul }}, {{ $total_kelas }}, {{ $total_peserta }}],
                backgroundColor: ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#6f42c1'],
                borderRadius: 8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 }, suggestedMax: Math.max({{ $total_mhs }}, {{ $total_dosen }}, {{ $total_matkul }}, {{ $total_kelas }}, {{ $total_peserta }}) + 2 } }
        }
    });

    new Chart(document.getElementById('chartDistribusi'), {
        type: 'doughnut',
        data: {
            labels: ['Mahasiswa', 'Dosen', 'Kelas'],
            datasets: [{
                data: [{{ $total_mhs }}, {{ $total_dosen }}, {{ $total_kelas }}],
                backgroundColor: ['#0d6efd', '#198754', '#ffc107'],
                borderWidth: 0,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });
</script>
@endpush