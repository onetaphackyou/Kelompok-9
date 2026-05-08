@extends('layouts.app')

@section('title', 'Data Mahasiswa')
@section('active_mahasiswa', 'active')

@section('content')
<h4 class="section-title">Data Mahasiswa</h4>
<div class="card">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th width="60">No</th>
                    <th>ID Mahasiswa</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>Prodi</th>
                    <th>Periode</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mahasiswas as $no => $m)
                <tr>
                    <td>{{ $no+1 }}</td>
                    <td>{{ $m->id_mhs }}</td>
                    <td>{{ $m->nim }}</td>
                    <td>{{ $m->nama }}</td>
                    <td>{{ $m->tempat_lahir ?? '-' }}</td>
                    <td>{{ $m->tanggal_lahir ?? '-' }}</td>
                    <td>{{ $m->jenis_kelamin == 'L' ? 'Laki-laki' : ($m->jenis_kelamin == 'P' ? 'Perempuan' : '-') }}</td>
                    <td>{{ $m->agama ?? '-' }}</td>
                    <td>{{ $m->prodi }}</td>
                    <td>{{ $m->periode }}</td>
                </tr>
                @empty
                <tr><td colspan="10" class="text-center text-muted">Data mahasiswa belum tersedia</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
