@extends('layouts.templatestff')

@section('content')
<div class="container">
    <h4>Items Table</h4>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Category</th>
                <th>Name</th>
                <th>Total</th>
                <th>Available</th>
                <th>Lending Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->category->name }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->total }}</td>
                <td>{{ $item->available }}</td>
                <td>{{ $item->lending_total }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection