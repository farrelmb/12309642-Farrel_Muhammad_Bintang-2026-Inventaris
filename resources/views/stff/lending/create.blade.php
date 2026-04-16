@extends('layouts.templatestff')

@section('content')
    <div class="container">
        <h4>Lending Form</h4>

        <form action="{{ route('lendingstff.store') }}" method="POST">
            @csrf

            {{-- Nama --}}
            <div class="mb-3">
                <label>Borrower Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            {{-- Wrapper item --}}
            <div id="itemsWrapper">
                <div class="item-group border p-3 mb-3">

                    <button type="button" class="btn btn-danger btn-sm float-end removeItem"
                        style="display:none;">❌</button>

                    <div class="mb-3">
                        <label>Items</label>
                        <select name="items[0][item_id]" class="form-control itemSelect" required>
                            <option value="">Select Item</option>
                            @foreach ($items as $item)
                                <option value="{{ $item->id }}" data-available="{{ $item->available }}">
                                    {{ $item->name }} (Stock: {{ $item->available }})
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted stockInfo"></small>
                    </div>

                    <div class="mb-3">
                        <label>Total</label>
                        <input type="number" name="items[0][total]" class="form-control totalInput" required>
                    </div>

                </div>
            </div>

            {{-- Tombol tambah --}}
            <button type="button" id="addItem" class="btn btn-primary mb-3">
                + More
            </button>

            <br>
            <div class="mb-3">
                <label>Keterangan <span class="text-danger">*</span></label>
                <textarea name="ket" class="form-control" required></textarea>
            </div>
            <button class="btn btn-success">Submit</button>
        </form>
    </div>

    {{-- TEMPLATE --}}
    <template id="itemTemplate">
        <div class="item-group border p-3 mb-3">
            <button type="button" class="btn btn-danger btn-sm float-end removeItem">❌</button>

            <div class="mb-3">
                <label>Items</label>
                <select class="form-control itemSelect" required>
                    <option value="">Select Item</option>
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}" data-available="{{ $item->available }}">
                            {{ $item->name }} (Stock: {{ $item->available }})
                        </option>
                    @endforeach
                </select>
                <small class="text-muted stockInfo"></small>
            </div>

            <div class="mb-3">
                <label>Total</label>
                <input type="number" class="form-control totalInput" required>
            </div>
        </div>
    </template>

    {{-- JAVASCRIPT --}}
    <script>
        let index = 1;

        // Tambah item
        document.getElementById('addItem').addEventListener('click', function() {
            const template = document.getElementById('itemTemplate').content.cloneNode(true);

            const group = template.querySelector('.item-group');
            const select = template.querySelector('.itemSelect');
            const input = template.querySelector('.totalInput');

            // set name dinamis
            select.name = `items[${index}][item_id]`;
            input.name = `items[${index}][total]`;

            index++;

            document.getElementById('itemsWrapper').appendChild(template);
        });

        // Hapus item
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('removeItem')) {
                e.target.closest('.item-group').remove();
            }
        });

        // Event stok & validasi
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('itemSelect')) {
                const selected = e.target.options[e.target.selectedIndex];
                const available = selected.getAttribute('data-available');
                const group = e.target.closest('.item-group');

                const stockInfo = group.querySelector('.stockInfo');
                const totalInput = group.querySelector('.totalInput');

                if (available) {
                    stockInfo.innerText = "Stock: " + available;
                    totalInput.max = available;
                }
            }
        });

        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('totalInput')) {
                const max = e.target.max;

                if (max && parseInt(e.target.value) > parseInt(max)) {
                    alert("Melebihi stok!");
                    e.target.value = max;
                }
            }
        });
    </script>
@endsection
