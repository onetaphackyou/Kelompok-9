@extends('layouts.app')

@section('title', 'Data Mata Kuliah')
@section('active_matkul', 'active')

@section('content')
<h4 class="section-title">Data Mata Kuliah</h4>
<div class="card">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th width="60">No</th>
                    <th>Nama Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Semester</th>
                    <th>Jenis</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mata_kuliahs as $no => $mk)
                <tr>
                    <td>{{ $no+1 }}</td>
                    <td>{{ $mk->nama_matkul }}</td>
                    <td>{{ $mk->sks }}</td>
                    <td>{{ $mk->semester }}</td>
                    <td>{{ $mk->jenis_matkul }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted">Data mata kuliah belum tersedia</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
