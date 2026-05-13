@extends('layouts.admin')

@section('title', 'Daftar Kelas')
@section('active_kelas', 'active')
@section('content')
<h2 class="section-title">Daftar Kelas</h2>
<div class="table-responsive" style="background:white;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,.08);">
    <table class="table table-hover mb-0">
        <thead style="background:#667eea;color:white;"><tr><th>No</th><th>Mata Kuliah</th><th>Kelas</th><th>Ruangan</th><th>Hari</th><th>Jam</th><th>Periode</th><th>Aksi</th></tr></thead>
        <tbody>
            @foreach($kelas as $no => $k)
            <tr>
                <td>{{ $no+1 }}</td>
                <td>{{ $k->mataKuliah->nama_matkul }}</td>
                <td>{{ $k->nama_kelas }}</td>
                <td>{{ $k->ruangan }}</td>
                <td>{{ $k->hari }}</td>
                <td>{{ $k->jam_awal }} - {{ $k->jam_akhir }}</td>
                <td>{{ $k->periode }}</td>
                <td><a href="{{ route('mahasiswa.kelas.detail', $k->id_kelas) }}" class="btn-detail">Detail</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
