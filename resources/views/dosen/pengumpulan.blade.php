@extends('layouts.admin')

@section('title', 'Pengumpulan Tugas')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Pengumpulan Tugas: {{ $tugas->judul_tugas }}</h5>
        <p>Kelas: {{ $kelas->mataKuliah->nama_matkul }} - {{ $kelas->nama_kelas }}</p>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr><th>NIM</th><th>Nama Mahasiswa</th><th>Status</th><th>File</th><th>Nilai</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($pengumpulan as $peserta)
                    @php $p = $peserta->penilaian; @endphp
                    <tr>
                        <td>{{ $peserta->mahasiswa->nim }}</td>
                        <td>{{ $peserta->mahasiswa->nama }}</td>
                        <td><span class="badge {{ $p && $p->status == 'diserahkan' ? 'bg-success' : 'bg-warning' }}">
                            {{ $p && $p->status == 'diserahkan' ? 'Sudah Dikumpulkan' : 'Belum Dikumpulkan' }}
                        </span></td>
                        <td>
                            @if($p && $p->upload_file)
                                <a href="{{ Storage::url($p->upload_file) }}" download class="btn btn-sm btn-primary">Download</a>
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $p && $p->nilai ? $p->nilai : '-' }}</td>
                        <td>
                            @if($p && $p->status == 'diserahkan')
                                <a href="{{ route('dosen.nilai.create', $p->id_nilai) }}" class="btn btn-sm btn-warning">Beri Nilai</a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center">Belum ada data pengumpulan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <a href="{{ route('dosen.kelas.detail', $kelas->id_kelas) }}" class="btn btn-secondary">Kembali ke Detail Kelas</a>
    </div>
</div>
@endsection
