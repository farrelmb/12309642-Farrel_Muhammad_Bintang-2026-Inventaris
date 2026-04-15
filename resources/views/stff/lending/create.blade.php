@extends('layouts.templatestff')

@section('content')
<div class="container">
    <h4>Lending Form</h4>
    <p>Please fill all input with right value.</p>

    <form action="{{ route('lendingstff.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Borrower Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Items</label>
            <select name="item_id" class="form-control">
                <option value="">Select Item</option>
                @foreach($items as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->name }} (Available: {{ $item->available }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Total</label>
            <input type="number" name="total" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Ket</label>
            <textarea name="ket" class="form-control"></textarea>
        </div>

        <button class="btn btn-success">Submit</button>
    </form>
</div>
@endsection