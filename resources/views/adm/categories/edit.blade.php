@extends('layouts.templateadm')

@section('content')
<div class="container">
    <h4>Edit Category Forms</h4>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ $category->name }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Division PJ</label>
            <select name="division" class="form-control">
                <option {{ $category->division == 'Sarpras' ? 'selected' : '' }}>Sarpras</option>
                <option {{ $category->division == 'Tata Usaha' ? 'selected' : '' }}>Tata Usaha</option>
                <option {{ $category->division == 'Tefa' ? 'selected' : '' }}>Tefa</option>
            </select>
        </div>

        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection