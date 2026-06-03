@extends('layouts.admin')

@section('title', 'Jadwal Perkuliahan')
@section('active_jadwal', 'active')

@section('content')
<h4 class="mb-4 section-title"><i class="fas fa-calendar-alt me-2"></i>Jadwal Perkuliahan</h4>

<div class="card">
    <div class="card-body">
        <div style="overflow-x:auto;">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mata Kuliah</th>
                        <th>Kelas</th>
                        <th>Dosen</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Ruangan</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwal_list as $no => $j)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td>{{ $j->kelas->mataKuliah->nama_matkul }}</td>
                        <td>{{ $j->kelas->nama_kelas }}</td>
                        <td>{{ $j->kelas->dosen->nama }}</td>
                        <td>{{ $j->hari }}</td>
                        <td>{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</td>
                        <td>{{ $j->ruangan }}</td>
                        <td>{{ $j->keterangan ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center">Belum ada jadwal</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection