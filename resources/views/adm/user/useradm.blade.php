@extends('layouts.templateadm')

@section('content')
    <h2>Data User (Admin)</h2>

    {{-- ALERT SUCCESS --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <a href="/users/create" class="btn btn-success">
            + Tambah User
        </a>

        <a href="{{ route('users.export') }}" class="btn btn-primary">
            Export Excel
        </a>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>

        @foreach ($users as $u)
            <tr>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->role }}</td>
                <td>
                    <a href="/users/edit/{{ $u->id }}" class="btn btn-warning btn-sm">Edit</a>

                    {{-- CEGAH DELETE DIRI SENDIRI --}}
                    @if ($u->id !== auth()->id())
                        <a href="/users/delete/{{ $u->id }}" class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin mau hapus user ini?')">
                            Delete
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
@endsection
