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

    <input type="text" name="name" value="{{ $user->name }}" class="form-control mb-2" placeholder="Nama">

    <input type="email" name="email" value="{{ $user->email }}" class="form-control mb-2" placeholder="Email">

    <input type="password" name="password" class="form-control mb-2" placeholder="Password baru (opsional)">

    <button class="btn btn-primary">Update</button>
</form>
@endsection