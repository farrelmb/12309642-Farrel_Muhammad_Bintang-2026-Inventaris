@extends('layouts.templatestff')

@section('content')
<div class="container">
    <h4>Lending Table</h4>
    <p>Data of <b>lendings</b></p>

    {{-- ================= FILTER ================= --}}
    <form method="GET" action="{{ route('lendingstff.index') }}" class="row mb-3">
        <div class="col-md-3">
            <input type="date" name="start_date" class="form-control"
                value="{{ request('start_date') }}">
        </div>

        <div class="col-md-3">
            <input type="date" name="end_date" class="form-control"
                value="{{ request('end_date') }}">
        </div>

        <div class="col-md-6 d-flex gap-2">
            <button class="btn btn-primary">Filter</button>

            <a href="{{ route('lendingstff.index') }}" class="btn btn-secondary">
                Reset
            </a>

            <a href="{{ route('lending.export', request()->only('start_date','end_date')) }}"
               class="btn btn-success">
                Export Excel
            </a>

            <a href="{{ route('lendingstff.create') }}" class="btn btn-success">
                + Add
            </a>
        </div>
    </form>

    {{-- ALERT --}}
    @if(session('success'))
        <div id="alert-success" class="alert alert-success shadow">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div id="alert-error" class="alert alert-danger shadow">
            {{ session('error') }}
        </div>
    @endif

    {{-- ================= TABLE ================= --}}
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
                    @if($lending->return_date)
                        {{ \Carbon\Carbon::parse($lending->return_date)->format('d F Y') }}
                    @else
                        <span class="badge bg-warning">Not Returned</span>
                    @endif
                </td>

                <td>
                    {{-- RETURN BUTTON --}}
                    @if(!$lending->return_date)
                        <button 
                            type="button"
                            class="btn btn-warning btn-sm openModal"
                            data-url="{{ route('lendingstff.returned', $lending->id) }}"
                            data-max="{{ $lending->total - ($lending->returned_total ?? 0) - ($lending->repair_total ?? 0) }}"
                        >
                            Returned
                        </button>
                    @endif

                    {{-- DELETE --}}
                    @if($lending->return_date)
                        <form action="{{ route('lendingstff.destroy', $lending->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    @else
                        <button class="btn btn-secondary btn-sm" disabled>Delete</button>
                    @endif
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

{{-- ================= MODAL ================= --}}
<div class="modal fade" id="returnModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" id="returnForm">
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                    <h5>Return Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Return Good</label>
                        <input type="number" id="returnedInput" name="returned_total" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Repair (Broken)</label>
                        <input type="number" id="repairInput" name="repair_total" class="form-control" value="0">
                    </div>

                    <small id="maxInfo" class="text-muted"></small>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- ================= AUTO HIDE ALERT ================= --}}
<script>
setTimeout(function() {
    let success = document.getElementById('alert-success');
    let error = document.getElementById('alert-error');

    if (success) {
        success.style.opacity = "0";
        setTimeout(() => success.remove(), 500);
    }

    if (error) {
        error.style.opacity = "0";
        setTimeout(() => error.remove(), 500);
    }
}, 2000);
</script>

{{-- ================= MODAL SCRIPT ================= --}}
<script>
document.addEventListener('click', function(e) {

    const button = e.target.closest('.openModal');
    if (!button) return;

    e.preventDefault();

    const url = button.dataset.url;
    const max = parseInt(button.dataset.max);

    const form = document.getElementById('returnForm');
    form.action = url;

    const returnedInput = document.getElementById('returnedInput');
    const repairInput = document.getElementById('repairInput');
    const maxInfo = document.getElementById('maxInfo');

    returnedInput.value = '';
    repairInput.value = 0;

    returnedInput.max = max;
    repairInput.max = max;

    maxInfo.innerText = "Max return: " + max;

    new bootstrap.Modal(document.getElementById('returnModal')).show();
});

document.getElementById('returnedInput').addEventListener('input', validateTotal);
document.getElementById('repairInput').addEventListener('input', validateTotal);

function validateTotal() {
    const returned = parseInt(document.getElementById('returnedInput').value) || 0;
    const repair = parseInt(document.getElementById('repairInput').value) || 0;
    const max = parseInt(document.getElementById('returnedInput').max);

    if (returned + repair > max) {
        alert("Jumlah melebihi sisa!");
        document.getElementById('returnedInput').value = '';
        document.getElementById('repairInput').value = 0;
    }
}
</script>

@endsection