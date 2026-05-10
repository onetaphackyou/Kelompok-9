{{-- resources/views/admin_prodi/materi.blade.php --}}
@extends('layouts.admin')

@section('title', 'Materi Perkuliahan')
@section('active_materi', 'active')

@section('content')
<h2 class="section-title">Daftar Materi</h2>

@if(!$id_kelas)
<div class="alert alert-info">Pilih kelas di halaman <a href="{{ route('admin_prodi.kelas') }}">Kelas</a> untuk melihat materi perkuliahan.</div>
@endif

<div class="table-responsive" style="background:white;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,.08);">
    <table class="table table-hover mb-0">
        <thead style="background:#667eea;color:white;">
            <tr>
                <th>No</th>
                <th>Judul Materi</th>
                <th>Deskripsi</th>
                <th>Jumlah Tugas</th>
            </tr>
        </thead>
        <tbody>
            @forelse($materi_list as $index => $materi)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $materi->judul_materi }}</td>
                    <td>{{ $materi->deskripsi ?? '-' }}</td>
                    <td>{{ $materi->tugas_count }}</td>
                </tr>
            @empty
                <tr><td colspan="4">Tidak ada materi yang ditemukan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
