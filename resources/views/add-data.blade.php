<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($spk) ? 'Edit Data' : 'Add Data' }}</title>
    <link rel="stylesheet" href="{{ asset('css/add-data.css') }}">
</head>
<body>

@include('layout.header')

<div class="page-content">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">{{ isset($spk) ? 'Edit Data' : 'Add Data' }}</h2>
        </div>

        <div class="card-body">
            <form method="POST"
                  action="{{ isset($spk) ? route('spk.update', $spk->id) : route('spk.store') }}">
                @csrf
                @if(isset($spk))
                    @method('PUT')
                @endif

                <div class="form-grid">

                    <div class="form-group">
                        <label>No SPK</label>
                        <input type="text" name="no_spk" value="{{ old('no_spk', $spk->no_spk ?? '') }}">
                        @error('no_spk') <small style="color:#c0392b;">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group">
                        <label>Customer</label>
                        <input type="text" name="customer" value="{{ old('customer', $spk->customer ?? '') }}">
                        @error('customer') <small style="color:#c0392b;">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group">
                        <label>Item Code</label>
                        <input type="text" name="item_code" value="{{ old('item_code', $spk->item_code ?? '') }}">
                        @error('item_code') <small style="color:#c0392b;">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group">
                        <label>Part No/Information</label>
                        <input type="text" name="part_no" value="{{ old('part_no', $spk->part_no ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label>Model</label>
                        <input type="text" name="model" value="{{ old('model', $spk->model ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label>PO Number</label>
                        <input type="text" name="po_number" value="{{ old('po_number', $spk->po_number ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label>Size</label>
                        <input type="text" name="size" value="{{ old('size', $spk->size ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label>Color</label>
                        <input type="text" name="color" value="{{ old('color', $spk->color ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label>Order Quantity</label>
                        <input type="text" name="order_quantity" value="{{ old('order_quantity', $spk->order_quantity ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label>Stock Quantity</label>
                        <input type="text" name="stock_quantity" value="{{ old('stock_quantity', $spk->stock_quantity ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label>Production</label>
                        <input type="text" name="production" value="{{ old('production', $spk->production ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label>Material</label>
                        <input type="text" name="material" value="{{ old('material', $spk->material ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label>Diameter Core</label>
                        <input type="text" name="diameter_core" value="{{ old('diameter_core', $spk->diameter_core ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label>Packing</label>
                        <input type="text" name="packing" value="{{ old('packing', $spk->packing ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label>SPK Date</label>
                        <input type="date" name="spk_date"
                               value="{{ old('spk_date', isset($spk) && $spk->spk_date ? \Illuminate\Support\Carbon::parse($spk->spk_date)->format('Y-m-d') : '') }}">
                    </div>

                    <div class="form-group">
                        <label>Order Date</label>
                        <input type="date" name="order_date"
                               value="{{ old('order_date', isset($spk) && $spk->order_date ? \Illuminate\Support\Carbon::parse($spk->order_date)->format('Y-m-d') : '') }}">
                    </div>

                    <div class="form-group form-full">
                        <label>Keterangan</label>
                        <textarea rows="4" name="keterangan">{{ old('keterangan', $spk->keterangan ?? '') }}</textarea>
                    </div>

                </div>

                <input type="hidden" name="status" id="statusInput"
                       value="{{ old('status', $spk->status ?? 'Pending') }}">

                <div class="form-footer">
                    <div style="position: relative;">
                        <button type="button" class="btn-status" onclick="toggleStatusDropdown()">
                            <span id="statusLabel">Status SPK</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"/>
                            </svg>
                        </button>

                        <div class="status-dropdown" id="statusDropdown">
                            <div class="status-item" onclick="selectStatus('Finished')">
                                <span class="label">Finished</span>
                                <span class="count">{{ $statusCounts['Finished'] ?? 0 }}</span>
                            </div>
                            <div class="status-item ongoing" onclick="selectStatus('On Going')">
                                <span class="label">On Going</span>
                                <span class="count">{{ $statusCounts['On Going'] ?? 0 }}</span>
                            </div>
                            <div class="status-item pending" onclick="selectStatus('Pending')">
                                <span class="label">Pending</span>
                                <span class="count">{{ $statusCounts['Pending'] ?? 0 }}</span>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn-cancel"
                            onclick="window.location.href='{{ route('dashboard') }}'">
                        Cancel
                    </button>

                    <button type="submit" class="btn-save">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleStatusDropdown() {
        const dropdown = document.getElementById('statusDropdown');
        dropdown.classList.toggle('show');
    }

    document.addEventListener('click', function(e) {
        const wrapper = document.querySelector('.btn-status').parentElement;
        if (!wrapper.contains(e.target)) {
            document.getElementById('statusDropdown').classList.remove('show');
        }
    });

    function selectStatus(status) {
        document.getElementById('statusInput').value = status;
        document.getElementById('statusLabel').textContent = status;
        document.getElementById('statusDropdown').classList.remove('show');
    }

    // set initial label from current hidden value
    document.getElementById('statusLabel').textContent = document.getElementById('statusInput').value;
</script>

</body>
</html>
