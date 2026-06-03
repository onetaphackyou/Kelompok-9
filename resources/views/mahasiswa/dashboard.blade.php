@extends('layouts.admin')

@section('title', 'Dashboard Mahasiswa')
@section('active_dashboard', 'active')

@section('content')
<h4 class="mb-4 section-title">Dashboard Mahasiswa</h4>

{{-- Baris 1: Statistik Cards --}}
<div class="row g-3 mb-3">
    <div class="col-6 col-md-4">
        <div class="card card-stat text-center p-3">
            <i class="fas fa-school fa-2x mb-2" style="opacity:0.8"></i>
            <h3>{{ $kelas_count }}</h3>
            <p>Total Kelas</p>
        </div>
    </div>
    <div class="col-6 col-md-4">
        <div class="card card-stat text-center p-3">
            <i class="fas fa-file-alt fa-2x mb-2" style="opacity:0.8"></i>
            <h3>{{ $materi_count }}</h3>
            <p>Total Materi</p>
        </div>
    </div>
    <div class="col-6 col-md-4">
        <div class="card card-stat text-center p-3">
            <i class="fas fa-tasks fa-2x mb-2" style="opacity:0.8"></i>
            <h3>{{ $tugas_count }}</h3>
            <p>Total Tugas</p>
        </div>
    </div>
</div>

{{-- Baris 2: Statistik Cards --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-4">
        <div class="card card-stat text-center p-3">
            <i class="fas fa-check-circle fa-2x mb-2" style="opacity:0.8"></i>
            <h3>{{ $tugas_selesai }}</h3>
            <p>Tugas Selesai</p>
        </div>
    </div>
    <div class="col-6 col-md-4">
        <div class="card card-stat text-center p-3">
            <i class="fas fa-hourglass-half fa-2x mb-2" style="opacity:0.8"></i>
            <h3>{{ $tugas_pending }}</h3>
            <p>Tugas Pending</p>
        </div>
    </div>
    <div class="col-6 col-md-4">
        <div class="card card-stat text-center p-3">
            <i class="fas fa-star fa-2x mb-2" style="opacity:0.8"></i>
            <h3>{{ $nilai_rata }}</h3>
            <p>Nilai Rata-rata</p>
        </div>
    </div>
</div>

{{-- Baris 3: Progress Bar --}}
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="card p-3">
            <h6 class="mb-3"><i class="fas fa-graduation-cap me-2"></i>Progress Belajar</h6>
            @php
                $progress = $tugas_count > 0 ? round(($tugas_selesai / $tugas_count) * 100) : 0;
            @endphp
            <div class="mb-2 d-flex justify-content-between">
                <small>Tugas Dikumpulkan</small>
                <small>{{ $tugas_selesai }}/{{ $tugas_count }} ({{ $progress }}%)</small>
            </div>
            <div class="progress" style="height: 12px; border-radius: 10px;">
                <div class="progress-bar bg-primary" style="width: {{ $progress }}%; border-radius: 10px;"></div>
            </div>
        </div>
    </div>
</div>

{{-- Baris 4: Grafik --}}
<div class="row g-3">
    <div class="col-md-6">
        <div class="card p-3" style="height: 320px;">
            <h6 class="mb-3"><i class="fas fa-chart-pie me-2"></i>Status Tugas</h6>
            <div style="position:relative; height:240px;">
                <canvas id="chartTugas"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card p-3" style="height: 320px;">
            <h6 class="mb-3"><i class="fas fa-chart-bar me-2"></i>Ringkasan Akademik</h6>
            <div style="position:relative; height:240px;">
                <canvas id="chartAkademik"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(document.getElementById('chartTugas'), {
        type: 'doughnut',
        data: {
            labels: ['Sudah Dikumpulkan', 'Belum Dikumpulkan'],
            datasets: [{
                data: [{{ $tugas_selesai }}, {{ $tugas_pending }}],
                backgroundColor: ['#198754', '#dc3545'],
                borderWidth: 0,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });

    new Chart(document.getElementById('chartAkademik'), {
        type: 'bar',
        data: {
            labels: ['Kelas', 'Materi', 'Tugas', 'Selesai', 'Pending'],
            datasets: [{
                label: 'Jumlah',
                data: [{{ $kelas_count }}, {{ $materi_count }}, {{ $tugas_count }}, {{ $tugas_selesai }}, {{ $tugas_pending }}],
                backgroundColor: ['#0d6efd', '#198754', '#ffc107', '#20c997', '#dc3545'],
                borderRadius: 8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 }, suggestedMax: Math.max({{ $kelas_count }}, {{ $materi_count }}, {{ $tugas_count }}) + 2 } }
        }
    });
</script>
@endpush