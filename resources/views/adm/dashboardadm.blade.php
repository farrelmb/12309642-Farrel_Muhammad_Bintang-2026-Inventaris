@extends('layouts.templateadm')

@section('content')
<div class="container">
    <h3 class="mb-4">Dashboard Admin</h3>

    <div class="row">

        {{-- CATEGORY --}}
        <div class="col-md-4 mb-3">
            <div class="card shadow border-0 rounded">
                <div class="card-body text-center">
                    <h5 class="text-muted">Total Category</h5>
                    <h2 class="fw-bold">{{ $totalCategory }}</h2>
                </div>
            </div>
        </div>

        {{-- REPAIR --}}
        <div class="col-md-4 mb-3">
            <div class="card shadow border-0 rounded">
                <div class="card-body text-center">
                    <h5 class="text-muted">Item in Repair</h5>
                    <h2 class="fw-bold text-warning">{{ $totalRepair }}</h2>
                </div>
            </div>
        </div>

        {{-- LENDING --}}
        <div class="col-md-4 mb-3">
            <div class="card shadow border-0 rounded">
                <div class="card-body text-center">
                    <h5 class="text-muted">Item Lending</h5>
                    <h2 class="fw-bold text-danger">{{ $totalLending }}</h2>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection