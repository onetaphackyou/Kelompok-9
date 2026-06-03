@extends('layouts.admin')

@section('title', 'Jadwal Perkuliahan')
@section('active_jadwal', 'active')

@section('content')
<h4 class="mb-4 section-title"><i class="fas fa-calendar-alt me-2"></i>Jadwal Perkuliahan</h4>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Tambah Jadwal</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin_prodi.jadwal.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-3">
                    <select name="id_kelas" class="form-select" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($kelas_list as $k)
                        <option value="{{ $k->id_kelas }}">{{ $k->mataKuliah->nama_matkul }} - {{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="hari" class="form-select" required>
                        <option value="">-- Pilih Hari --</option>
                        @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari)
                        <option value="{{ $hari }}">{{ $hari }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="time" name="jam_mulai" class="form-control" required placeholder="Jam Mulai">
                </div>
                <div class="col-md-2">
                    <input type="time" name="jam_selesai" class="form-control" required placeholder="Jam Selesai">
                </div>
                <div class="col-md-2">
                    <input type="text" name="ruangan" class="form-control" required placeholder="Ruangan">
                </div>
                <div class="col-md-2">
                    <input type="text" name="keterangan" class="form-control" placeholder="Keterangan (opsional)">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-success w-100">+ Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Daftar Jadwal</h5>
    </div>
    <div class="card-body">
        <div style="overflow-x: auto;">
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
                        <th>Aksi</th>
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
                        <td>
                            <form action="{{ route('admin_prodi.jadwal.hapus', $j->id_jadwal) }}" method="POST" onsubmit="return confirm('Hapus jadwal?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="9" class="text-center">Belum ada jadwal</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection