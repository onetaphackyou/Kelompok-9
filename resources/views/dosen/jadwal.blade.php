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
                        <th>Status</th>
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
                            @if($j->status_request != 'pending')
                            <button class="btn btn-sm btn-warning" onclick="openModal({{ $j->id_jadwal }})">
                                <i class="fas fa-edit"></i> Request Ubah
                            </button>
                            @else
                            <span class="text-muted small">Menunggu persetujuan...</span>
                            @endif
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

{{-- Modal di luar tabel --}}
@foreach($jadwal_list as $j)
<div class="modal fade" id="requestJadwal{{ $j->id_jadwal }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Request Perubahan Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('dosen.jadwal.request', $j->id_jadwal) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p class="text-muted small mb-3">Jadwal saat ini: <strong>{{ $j->hari }}, {{ $j->jam_mulai }} - {{ $j->jam_selesai }}, {{ $j->ruangan }}</strong></p>
                    <div class="mb-3">
                        <label class="form-label">Hari Baru</label>
                        <select name="hari_request" class="form-select" required>
                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari)
                            <option value="{{ $hari }}" {{ $j->hari == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jam Mulai</label>
                        <input type="time" name="jam_mulai_request" class="form-control" value="{{ $j->jam_mulai }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jam Selesai</label>
                        <input type="time" name="jam_selesai_request" class="form-control" value="{{ $j->jam_selesai }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ruangan</label>
                        <input type="text" name="ruangan_request" class="form-control" value="{{ $j->ruangan }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <input type="text" name="keterangan_request" class="form-control" value="{{ $j->keterangan }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Kirim Request</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('scripts')
<script>
function openModal(id) {
    var modal = new bootstrap.Modal(document.getElementById('requestJadwal' + id));
    modal.show();
}
</script>
@endpush