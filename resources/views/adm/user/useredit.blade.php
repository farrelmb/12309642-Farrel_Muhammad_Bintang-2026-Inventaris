@extends('layouts.templateadm')

@section('content')
<h2>Edit User</h2>

<form method="POST" action="/users/update/{{ $user->id }}">
    @csrf

    <input type="text" name="name" value="{{ $user->name }}" class="form-control mb-2">
    <input type="email" name="email" value="{{ $user->email }}" class="form-control mb-2">
    <input type="password" name="password" placeholder="Password baru (opsional)" class="form-control mb-2">

    <select name="role" class="form-control mb-2">
        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Operator</option>
    </select>

    <button class="btn btn-primary">Update</button>
</form>
@endsection