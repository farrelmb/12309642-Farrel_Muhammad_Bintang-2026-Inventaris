@extends('layouts.templatestff')

@section('content')
<div class="container">
    <h4>Lending Table</h4>
    <p>Data of <b>lendings</b></p>

    <a href="{{ route('lendingstff.create') }}" class="btn btn-success mb-3">
        + Add
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Item</th>
                <th>Total</th>
                <th>Name</th>
                <th>Ket</th>
                <th>Date</th>
                <th>Returned</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lendings as $lending)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $lending->item->name }}</td>
                <td>{{ $lending->total }}</td>
                <td>{{ $lending->name }}</td>
                <td>{{ $lending->ket }}</td>
                <td>{{ $lending->created_at->format('d F Y') }}</td>
                <td>
                    {{ $lending->return_date ? \Carbon\Carbon::parse($lending->return_date)->format('d F Y') : 'not returned' }}
                </td>
                <td>
                    @if(!$lending->return_date)
                    <form action="{{ route('lendingstff.returned', $lending->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-warning btn-sm">Returned</button>
                    </form>
                    @endif

                    <form action="{{ route('lendingstff.destroy', $lending->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">Belum ada data lending</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection