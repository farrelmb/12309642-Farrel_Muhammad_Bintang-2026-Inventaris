@extends('layouts.templateadm')

@section('content')
<div class="container">
    <h4>Categories Table</h4>
    <p>Add, delete, update <b>categories</b></p>

    <a href="{{ route('categories.create') }}" class="btn btn-success mb-3">+ Add</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Division PJ</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $c)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $c->name }}</td>
                <td>{{ $c->division }}</td>
                <td>
                    <a href="{{ route('categories.edit', $c->id) }}" class="btn btn-primary btn-sm">Edit</a>

                    <form action="{{ route('categories.destroy', $c->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection