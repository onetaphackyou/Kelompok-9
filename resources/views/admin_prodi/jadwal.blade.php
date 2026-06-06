@extends('layouts.admin')

@section('title', 'Jadwal Perkuliahan')
@section('active_jadwal', 'active')

@section('content')
<h4 class="mb-4 section-title"><i class="fas fa-calendar-alt me-2"></i>Jadwal Perkuliahan</h4>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if($pending_count > 0)
<div class="alert alert-warning">
    <i class="fas fa-bell me-2"></i> Ada <strong>{{ $pending_count }}</strong> request perubahan jadwal yang menunggu persetujuan!
</div>
@endif

{{-- Form Tambah Jadwal --}}
<div class="card mb-4">
    <div class="card-header"><h5 class="mb-0">Tambah Jadwal</h5></div>
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
                    <input type="time" name="jam_mulai" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <input type="time" name="jam_selesai" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <input type="text" name="ruangan" class="form-control" placeholder="Ruangan" required>
                </div>
                <div class="col-md-2">
                    <input type="text" name="keterangan" class="form-control" placeholder="Keterangan">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-success w-100">+ Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Daftar Jadwal --}}
<div class="card">
    <div class="card-header"><h5 class="mb-0">Daftar Jadwal</h5></div>
    <div class="card-body">
        <div style="overflow-x:auto;">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mata Kuliah</th>
                        <th>Kelas</th>
                        <th>Dosen</th>
                        <th>Jadwal Aktif</th>
                        <th>Request Perubahan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwal_list as $no => $j)
                    <tr class="{{ $j->status_request == 'pending' ? 'table-warning' : '' }}">
                        <td>{{ $no + 1 }}</td>
                        <td>{{ $j->kelas->mataKuliah->nama_matkul }}</td>
                        <td>{{ $j->kelas->nama_kelas }}</td>
                        <td>{{ $j->kelas->dosen->nama }}</td>
                        <td>
                            {{ $j->hari }}, {{ $j->jam_mulai }} - {{ $j->jam_selesai }}<br>
                            <small>{{ $j->ruangan }}</small>
                        </td>
                        <td>
                            @if($j->status_request == 'pending')
                                <strong>{{ $j->hari_request }}</strong>, {{ $j->jam_mulai_request }} - {{ $j->jam_selesai_request }}<br>
                                <small>{{ $j->ruangan_request }}</small>
                                @if($j->keterangan_request)
                                <br><small class="text-muted">{{ $j->keterangan_request }}</small>
                                @endif
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($j->status_request == 'pending')
                                <span class="badge bg-warning">Menunggu</span>
                            @elseif($j->status_request == 'approved')
                                <span class="badge bg-success">Disetujui</span>
                            @elseif($j->status_request == 'rejected')
                                <span class="badge bg-danger">Ditolak</span>
                            @else
                                <span class="badge bg-secondary">-</span>
                            @endif
                        </td>
                        <td>
                            @if($j->status_request == 'pending')
                                <form action="{{ route('admin_prodi.jadwal.approve', $j->id_jadwal) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-check"></i> Setuju
                                    </button>
                                </form>
                                <form action="{{ route('admin_prodi.jadwal.reject', $j->id_jadwal) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-times"></i> Tolak
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin_prodi.jadwal.hapus', $j->id_jadwal) }}" method="POST" onsubmit="return confirm('Hapus jadwal?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            @endif
                        </td>
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