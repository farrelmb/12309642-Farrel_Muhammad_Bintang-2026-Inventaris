@extends('layouts.templateadm')

@section('content')
<h2>Data User (Admin)</h2>

<a href="/users/create" class="btn btn-success mb-3">+ Tambah User</a>

<table class="table table-bordered">
    <tr>
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>
        <th>Aksi</th>
    </tr>

    @foreach($users as $u)
    <tr>
        <td>{{ $u->name }}</td>
        <td>{{ $u->email }}</td>
        <td>{{ $u->role }}</td>
        <td>
            <a href="/users/edit/{{ $u->id }}" class="btn btn-warning btn-sm">Edit</a>
            <a href="/users/delete/{{ $u->id }}" class="btn btn-danger btn-sm">Delete</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection