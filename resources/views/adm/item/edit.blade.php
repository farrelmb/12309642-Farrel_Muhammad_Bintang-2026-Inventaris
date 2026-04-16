@extends('layouts.templateadm')

@section('content')
<div class="container">
    <h4>Edit Item</h4>
    <p>Update item data</p>

    {{-- ALERT --}}
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('items.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- NAME --}}
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input 
                type="text" 
                name="name" 
                class="form-control"
                value="{{ old('name', $item->name) }}">
        </div>

        {{-- CATEGORY --}}
        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-control select2">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" 
                        {{ $item->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- TOTAL --}}
        <div class="mb-3">
            <label class="form-label">Total</label>
            <input 
                type="number" 
                name="total" 
                class="form-control"
                value="{{ old('total', $item->total) }}">
        </div>

        {{-- TAMBAH BARANG RUSAK --}}
        <div class="mb-3">
            <label class="form-label">
                New Broke Item (current: {{ $item->repair }})
            </label>
            <input 
                type="number" 
                name="new_broke" 
                class="form-control"
                value="0">
            <small class="text-muted">Tambah jumlah barang rusak</small>
        </div>

        {{-- PERBAIKI BARANG --}}
        <div class="mb-3">
            <label class="form-label">
                Fixed Item (repair available: {{ $item->repair }})
            </label>
            <input 
                type="number" 
                name="fixed_item" 
                id="fixedItem"
                class="form-control"
                value="0">
            <small class="text-muted">Jumlah barang yang sudah diperbaiki</small>
        </div>

        {{-- BUTTON --}}
        <div class="d-flex justify-content-end">
            <a href="{{ route('items.index') }}" class="btn btn-secondary me-2">Cancel</a>
            <button type="submit" class="btn btn-primary">Update</button>
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

// VALIDASI FIXED ITEM
document.getElementById('fixedItem').addEventListener('input', function() {
    let max = {{ $item->repair }};
    if (this.value > max) {
        alert("Tidak boleh melebihi jumlah repair!");
        this.value = 0;
    }
});
</script>
@endsection