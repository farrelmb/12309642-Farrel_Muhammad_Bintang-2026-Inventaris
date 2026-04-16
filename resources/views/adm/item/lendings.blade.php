@extends('layouts.templateadm')

@section('content')
<div class="container">
    <h4>Lending Table - {{ $item->name }}</h4>

    <a href="{{ route('items.index') }}" class="btn btn-secondary mb-3">Back</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Total</th>
                <th>Ket</th>
                <th>Date</th>
                <th>Returned</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lendings as $lending)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $lending->name }}</td>
                <td>{{ $lending->total }}</td>
                <td>{{ $lending->ket }}</td>
                <td>{{ $lending->created_at->format('d M Y') }}</td>
                <td>
                    @if($lending->return_date)
                        {{ $lending->return_date }}
                    @else
                        <span class="badge bg-warning">Not returned</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">No lending data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection