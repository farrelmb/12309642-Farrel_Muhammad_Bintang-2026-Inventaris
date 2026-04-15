@extends('layouts.templateadm')

@section('content')
<h2>Tambah User</h2>

<form method="POST" action="/users/store">
    @csrf

    <input type="text" name="name" placeholder="Nama" class="form-control mb-2">
    <input type="email" name="email" placeholder="Email" class="form-control mb-2">
    <input type="password" name="password" placeholder="Password" class="form-control mb-2">

    <select name="role" class="form-control mb-2">
        <option value="admin">Admin</option>
        <option value="staff">Operator</option>
    </select>

    <button class="btn btn-success">Simpan</button>
</form>
@endsection