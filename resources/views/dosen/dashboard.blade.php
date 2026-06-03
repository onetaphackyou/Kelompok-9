@extends('layouts.admin')

@section('title', 'Dashboard Dosen')
@section('active_dashboard', 'active')

@section('content')
<h4 class="mb-4 section-title">Dashboard Dosen</h4>

{{-- Baris 1: Statistik Cards --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card card-stat text-center p-3">
            <i class="fas fa-school fa-2x mb-2" style="opacity:0.8"></i>
            <h3>{{ $kelas_count }}</h3>
            <p>Total Kelas</p>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card card-stat text-center p-3">
            <i class="fas fa-user-graduate fa-2x mb-2" style="opacity:0.8"></i>
            <h3>{{ $mhs_count }}</h3>
            <p>Total Mahasiswa</p>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card card-stat text-center p-3">
            <i class="fas fa-file-alt fa-2x mb-2" style="opacity:0.8"></i>
            <h3>{{ $materi_count }}</h3>
            <p>Total Materi</p>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card card-stat text-center p-3">
            <i class="fas fa-tasks fa-2x mb-2" style="opacity:0.8"></i>
            <h3>{{ $tugas_count }}</h3>
            <p>Total Tugas</p>
        </div>
    </div>
</div>

{{-- Grafik --}}
<div class="row g-3">
    <div class="col-md-6">
        <div class="card p-3" style="height: 320px;">
            <h6 class="mb-3"><i class="fas fa-chart-bar me-2"></i>Statistik Kelas</h6>
            <div style="position:relative; height:240px;">
                <canvas id="chartKelas"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card p-3" style="height: 320px;">
            <h6 class="mb-3"><i class="fas fa-chart-pie me-2"></i>Distribusi Konten</h6>
            <div style="position:relative; height:240px;">
                <canvas id="chartKonten"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(document.getElementById('chartKelas'), {
        type: 'bar',
        data: {
            labels: ['Kelas', 'Mahasiswa', 'Materi', 'Tugas'],
            datasets: [{
                label: 'Jumlah',
                data: [{{ $kelas_count }}, {{ $mhs_count }}, {{ $materi_count }}, {{ $tugas_count }}],
                backgroundColor: ['#0d6efd', '#198754', '#ffc107', '#dc3545'],
                borderRadius: 8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 }, suggestedMax: Math.max({{ $kelas_count }}, {{ $mhs_count }}, {{ $materi_count }}, {{ $tugas_count }}) + 2 } }
        }
    });

    new Chart(document.getElementById('chartKonten'), {
        type: 'doughnut',
        data: {
            labels: ['Materi', 'Tugas'],
            datasets: [{
                data: [{{ $materi_count }}, {{ $tugas_count }}],
                backgroundColor: ['#0d6efd', '#ffc107'],
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