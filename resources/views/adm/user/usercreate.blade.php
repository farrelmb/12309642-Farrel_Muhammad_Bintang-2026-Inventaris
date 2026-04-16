@extends('layouts.templateadm')

@section('content')
<h2>Tambah User</h2>

<form method="POST" action="/users/store">
    @csrf

    <input type="text" name="name" value="{{ old('name') }}" 
        placeholder="Nama" class="form-control mb-2" required>
    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <input type="email" name="email" value="{{ old('email') }}" 
        placeholder="Email" class="form-control mb-2" required>
    @error('email')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <input type="password" name="password" 
        placeholder="Password" class="form-control mb-2" required>
    @error('password')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <select name="role" class="form-control mb-2" required>
        <option value="">-- Pilih Role --</option>
        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Operator</option>
    </select>
    @error('role')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <button class="btn btn-success">Simpan</button>
</form>
@endsection