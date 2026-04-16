@extends('layouts.templateadm')

@section('content')
<div class="container">

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div id="alert-success" class="alert alert-success shadow">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div id="alert-error" class="alert alert-danger shadow">
            {{ session('error') }}
        </div>
    @endif

    <h4>Categories Table</h4>
    <p>Add, delete, update <b>categories</b></p>

    <a href="{{ route('categories.create') }}" class="btn btn-success mb-3">+ Add</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Division PJ</th>
                <th>Total Items</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $c)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $c->name }}</td>
                <td>{{ $c->division }}</td>

                {{-- TOTAL ITEMS --}}
                <td>{{ $c->items_count }}</td>

                <td>
                    <a href="{{ route('categories.edit', $c->id) }}" class="btn btn-primary btn-sm">
                        Edit
                    </a>

                    @php
                        $hasLending = false;
                        foreach ($c->items as $item) {
                            if ($item->lendings->whereNull('return_date')->count() > 0) {
                                $hasLending = true;
                                break;
                            }
                        }
                    @endphp

                    @if(!$hasLending)
                        <form action="{{ route('categories.destroy', $c->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                Delete
                            </button>
                        </form>
                    @else
                        <span class="badge bg-danger">In Use</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- AUTO HIDE ALERT --}}
<script>
    setTimeout(function() {
        let success = document.getElementById('alert-success');
        let error = document.getElementById('alert-error');

        if (success) {
            success.style.transition = "opacity 0.5s";
            success.style.opacity = "0";
            setTimeout(() => success.remove(), 500);
        }

        if (error) {
            error.style.transition = "opacity 0.5s";
            error.style.opacity = "0";
            setTimeout(() => error.remove(), 500);
        }
    }, 2000); // 2 detik
</script>

@endsection