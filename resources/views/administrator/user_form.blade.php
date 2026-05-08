@extends('layouts.app')

@section('title', $action == 'add' ? 'Tambah User' : 'Edit User')
@section('active_user', 'active')

@section('content')
<div class="card p-4">
    <form method="POST" autocomplete="off">
        @csrf
        @if($action == 'edit') @method('PUT') @endif

        <div class="form-group mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="{{ old('username', $user->nama ?? '') }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Password {{ $action == 'edit' ? '<small class="text-muted">(Isi jika ingin ganti password)</small>' : '' }}</label>
            <input type="password" name="password" class="form-control" {{ $action == 'add' ? 'required' : '' }} placeholder="{{ $action == 'edit' ? 'Kosongkan jika tidak ingin ganti password' : '' }}">
        </div>

        <div class="form-row mb-3">
            <div class="form-group col-md-6">
                <label>Role</label>
                <select name="role" class="form-control" required id="role-select">
                    @foreach(['mahasiswa','dosen','admin_prodi','administrator'] as $r)
                        <option value="{{ $r }}" {{ (isset($user) && $user->role == $r) ? 'selected' : '' }}>{{ ucfirst($r) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="aktif" {{ (isset($user) && $user->status == 'aktif') ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ (isset($user) && $user->status == 'nonaktif') ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
        </div>

        <div class="form-group mb-3" id="prodi-field" style="display: {{ (isset($user) && $user->role == 'admin_prodi') ? 'block' : 'none' }};">
            <label>Program Studi</label>
            <select name="prodi" class="form-control">
                <option value="">Pilih Program Studi</option>
                <option value="Teknik Informatika" {{ (isset($user) && $user->prodi == 'Teknik Informatika') ? 'selected' : '' }}>Teknik Informatika</option>
                <option value="Sistem Informasi" {{ (isset($user) && $user->prodi == 'Sistem Informasi') ? 'selected' : '' }}>Sistem Informasi</option>
                <option value="Manajemen" {{ (isset($user) && $user->prodi == 'Manajemen') ? 'selected' : '' }}>Manajemen</option>
            </select>
        </div>

        <div class="btn-container">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('administrator.user.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.getElementById('role-select');
        const prodiField = document.getElementById('prodi-field');

        function toggleProdiField() {
            prodiField.style.display = roleSelect.value === 'admin_prodi' ? 'block' : 'none';
        }
        roleSelect.addEventListener('change', toggleProdiField);
        toggleProdiField();

        document.querySelector('form').addEventListener('submit', function(e) {
            if (roleSelect.value === 'admin_prodi') {
                const prodiInput = document.querySelector('select[name="prodi"]');
                if (!prodiInput.value || prodiInput.value.trim() === '') {
                    alert('Prodi wajib diisi untuk Admin Prodi!');
                    prodiInput.focus();
                    e.preventDefault();
                }
            }
        });
    });
</script>
@endpush
@endsection
