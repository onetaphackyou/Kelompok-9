@extends('layouts.admin')

@section('title', 'Nilai Perkuliahan')
@section('active_nilai', 'active')

@section('content')
<h4 class="mb-4 section-title"><i class="fas fa-star me-2"></i>Nilai Perkuliahan</h4>

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
                        <th>Nilai Akhir</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($nilai_list as $no => $n)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td>{{ $n->kelas->mataKuliah->nama_matkul }}</td>
                        <td>{{ $n->kelas->nama_kelas }}</td>
                        <td>{{ $n->kelas->dosen->nama }}</td>
                        <td>
                            @if($n->nilai_akhir)
                                <span class="badge {{ $n->nilai_akhir >= 60 ? 'bg-success' : 'bg-danger' }} fs-6">
                                    {{ $n->nilai_akhir }}
                                </span>
                            @else
                                <span class="badge bg-secondary">Belum dinilai</span>
                            @endif
                        </td>
                        <td>
                            @if($n->nilai_akhir)
                                @if($n->nilai_akhir >= 85) Sangat Baik
                                @elseif($n->nilai_akhir >= 70) Baik
                                @elseif($n->nilai_akhir >= 60) Cukup
                                @else Kurang
                                @endif
                            @else -
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center">Belum ada nilai</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection