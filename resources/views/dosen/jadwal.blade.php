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
                        <td>{{ $j->hari }}</td>
                        <td>{{ $j->jam_mulai }} - {{ $j->jam_selesai }}</td>
                        <td>{{ $j->ruangan }}</td>
                        <td>{{ $j->keterangan ?? '-' }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editJadwal{{ $j->id_jadwal }}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                        </td>
                    </tr>

                    {{-- Modal Edit --}}
                    <div class="modal fade" id="editJadwal{{ $j->id_jadwal }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Jadwal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('dosen.jadwal.update', $j->id_jadwal) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Hari</label>
                                            <select name="hari" class="form-select" required>
                                                @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari)
                                                <option value="{{ $hari }}" {{ $j->hari == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Jam Mulai</label>
                                            <input type="time" name="jam_mulai" class="form-control" value="{{ $j->jam_mulai }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Jam Selesai</label>
                                            <input type="time" name="jam_selesai" class="form-control" value="{{ $j->jam_selesai }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Ruangan</label>
                                            <input type="text" name="ruangan" class="form-control" value="{{ $j->ruangan }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Keterangan</label>
                                            <input type="text" name="keterangan" class="form-control" value="{{ $j->keterangan }}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr><td colspan="8" class="text-center">Belum ada jadwal</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection