@extends('layouts.admin')

@section('title', 'Data Kelas Perkuliahan')
@section('active_kelas', 'active')

@section('content')
<h4 class="section-title">Data Kelas Perkuliahan</h4>
<div class="card">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th width="60">No</th>
                    <th>Nama Kelas</th>
                    <th>Mata Kuliah</th>
                    <th>Program Studi</th>
                    <th>Jam Perkuliahan</th>
                    <th>Ruangan</th>
                    <th>Dosen</th>
                    <th>Tahun Akademik</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kelas as $no => $k)
                <tr>
                    <td>{{ $no+1 }}</td>
                    <td>{{ $k->nama_kelas }}</td>
                    <td>{{ $k->mataKuliah->nama_matkul ?? '-' }}</td>
                    <td>{{ $k->dosen->prodi ?? '-' }}</td>
                    <td>{{ $k->jam_awal }} - {{ $k->jam_akhir }}</td>
                    <td>{{ $k->ruangan ?? '-' }}</td>
                    <td>{{ $k->dosen->nama ?? '-' }}</td>
                    <td>{{ $k->periode }}</td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center text-muted">Data kelas perkuliahan belum tersedia</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
