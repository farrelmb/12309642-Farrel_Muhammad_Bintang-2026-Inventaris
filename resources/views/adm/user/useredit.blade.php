@extends('layouts.templateadm')

@section('content')
<h2>Edit User</h2>

<form method="POST" action="/users/update/{{ $user->id }}">
    @csrf

    <input type="text" name="name" 
        value="{{ old('name', $user->name) }}" 
        class="form-control mb-2" required>
    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <input type="email" name="email" 
        value="{{ old('email', $user->email) }}" 
        class="form-control mb-2" required>
    @error('email')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <input type="password" name="password" 
        placeholder="Password baru (opsional)" 
        class="form-control mb-2">
    @error('password')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <select name="role" class="form-control mb-2" required>
        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="staff" {{ old('role', $user->role) == 'staff' ? 'selected' : '' }}>Operator</option>
    </select>
    @error('role')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <button class="btn btn-primary">Update</button>
</form>
@endsection