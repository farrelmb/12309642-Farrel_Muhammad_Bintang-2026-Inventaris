@extends('layouts.templateadm')

@section('content')
    <div class="container">
        <h4>Items Table</h4>
        <p>Add, delete, update <b>items</b></p>

        <a href="{{ route('items.create') }}" class="btn btn-success mb-3">+ Add</a>
        <a href="{{ route('items.export') }}" class="btn btn-primary mb-3">
            Export Excel
        </a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Total</th>
                    <th>Repair</th>
                    <th>Lending</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->category->name ?? '-' }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->total }}</td>
                        <td>{{ $item->repair }}</td>

                        {{-- Kolom Lending --}}
                        <td>
                            @if ($item->lending_total > 0)
                                <a href="{{ route('items.lendings', $item->id) }}" class="text-primary fw-bold">
                                    {{ $item->lending_total }}
                                </a>
                            @else
                                0
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Data tidak ada</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
