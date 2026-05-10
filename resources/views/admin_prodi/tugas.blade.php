{{-- resources/views/admin_prodi/tugas.blade.php --}}
@extends('layouts.admin')

@section('title', 'Daftar Tugas')
@section('active_tugas', 'active')

@section('content')
<h2 class="section-title">Daftar Tugas</h2>

@if(!$id_kelas)
<div class="alert alert-info">Pilih kelas di halaman <a href="{{ route('admin_prodi.kelas') }}">Kelas</a> untuk melihat tugas perkuliahan.</div>
@endif

<div class="table-responsive" style="background:white;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,.08);">
    <table class="table table-hover mb-0">
        <thead style="background:#667eea;color:white;">
            <tr>
                <th>No</th>
                <th>Judul Tugas</th>
                <th>Materi</th>
                <th>Deadline</th>
                <th>Diserahkan</th>
                <th>Dinilai</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tugas_list as $index => $tugas)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $tugas->judul_tugas }}</td>
                    <td>{{ $tugas->materi->judul_materi ?? '-' }}</td>
                    <td>{{ optional($tugas->deadline)->format('d M Y H:i') ?? '-' }}</td>
                    <td>{{ $tugas->jumlah_diserahkan }}</td>
                    <td>{{ $tugas->jumlah_dinilai }}</td>
                </tr>
            @empty
                <tr><td colspan="6">Tidak ada tugas yang ditemukan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
