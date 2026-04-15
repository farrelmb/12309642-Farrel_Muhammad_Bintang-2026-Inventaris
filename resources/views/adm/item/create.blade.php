@extends('layouts.templateadm')

@section('content')
<div class="container">
    <h4>Add Item</h4>
    <p>Please fill all input with right value.</p>

    <form action="{{ route('items.store') }}" method="POST">
        @csrf

        {{-- NAME --}}
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input 
                type="text" 
                name="name" 
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}"
                placeholder="Nama Item">

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- CATEGORY --}}
        <div class="mb-3">
            <label class="form-label">Category</label>
            <select 
                name="category_id" 
                class="form-control select2 @error('category_id') is-invalid @enderror">
                
                <option value="">Pilih Category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- TOTAL --}}
        <div class="mb-3">
            <label class="form-label">Total</label>
            <input 
                type="number" 
                name="total" 
                class="form-control @error('total') is-invalid @enderror"
                value="{{ old('total') }}"
                placeholder="Total Item">

            @error('total')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- BUTTON --}}
        <div class="d-flex justify-content-end">
            <a href="{{ route('items.index') }}" class="btn btn-secondary me-2">Cancel</a>
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </form>
</div>

{{-- SELECT2 --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            width: '100%'
        });
    });
</script>
@endsection