@extends('layouts.templatestff')

@section('content')
<h2>Edit Profile</h2>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="/profile/update">
    @csrf

    <input type="text" name="name" value="{{ old('name', $user->name) }}" 
        class="form-control mb-2" placeholder="Nama" required>
    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <input type="email" name="email" value="{{ old('email', $user->email) }}" 
        class="form-control mb-2" placeholder="Email" required>
    @error('email')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <input type="password" name="password" 
        class="form-control mb-2" placeholder="Password baru (opsional)">
    @error('password')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    <button class="btn btn-primary">Update</button>
</form>
@endsection