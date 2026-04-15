@extends('layouts.templateadm')

@section('content')
<div class="container">
    <h4>Add Category Forms</h4>
    <p>Please <span style="color:red;">fill</span> all input form with right value.</p>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <small class="text-danger">The name field is required.</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Division PJ</label>
            <select name="division" class="form-control @error('division') is-invalid @enderror">
                <option value="">Select Division PJ</option>
                <option>Sarpras</option>
                <option>Tata Usaha</option>
                <option>Tefa</option>
            </select>

            @error('division')
                <small class="text-danger">The division pj field is required.</small>
            @enderror
        </div>

        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
        <button class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection