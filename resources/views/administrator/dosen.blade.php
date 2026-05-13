@extends('layouts.admin')

@section('title', 'Data Dosen')
@section('active_dosen', 'active')

@section('content')
<h4 class="section-title">Data Dosen</h4>
<div class="card">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th width="60">No</th>
                    <th>ID Dosen</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Prodi</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Agama</th>
                    <th>Jabatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dosens as $no => $d)
                <tr>
                    <td>{{ $no+1 }}</td>
                    <td>{{ $d->id_dosen }}</td>
                    <td>{{ $d->nip }}</td>
                    <td>{{ $d->nama }}</td>
                    <td>{{ $d->prodi }}</td>
                    <td>{{ $d->jenis_kelamin == 'L' ? 'Laki-laki' : ($d->jenis_kelamin == 'P' ? 'Perempuan' : '-') }}</td>
                    <td>{{ $d->tanggal_lahir ?? '-' }}</td>
                    <td>{{ $d->agama ?? '-' }}</td>
                    <td>{{ $d->jenis_jabatan ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="9" class="text-center text-muted">Data dosen belum tersedia</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
