@extends('layouts.app')

@section('title', 'Kelola User')
@section('active_user', 'active')

@section('content')
<h2 class="section-title">Kelola User</h2>
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('administrator.user.create') }}" class="btn btn-success">+ Tambah User</a>
</div>

<div class="card p-3">
    <table class="table table-hover mb-0">
        <thead>
            <tr>
                <th>No</th>
                <th>ID User</th>
                <th>Username</th>
                <th>Role</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $no => $u)
            <tr>
                <td>{{ $no+1 }}</td>
                <td>{{ $u->id_user }}</td>
                <td>{{ $u->nama }}</td>
                <td>{{ ucfirst($u->role) }}</td>
                <td>{{ ucfirst($u->status) }}</td>
                <td>
                    <a href="{{ route('administrator.user.edit', $u->id_user) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('administrator.user.destroy', $u->id_user) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus user?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center">Data user kosong</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
