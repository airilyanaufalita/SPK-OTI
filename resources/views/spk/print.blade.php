<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print SPK {{ $spk->no_spk }}</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 32px; color: #222; }
        h1 { font-size: 18px; margin-bottom: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        td { padding: 6px 8px; border-bottom: 1px solid #eee; vertical-align: top; }
        td.label { width: 200px; color: #666; }
    </style>
</head>
<body onload="window.print()">
    <h1>Surat Perintah Kerja - {{ $spk->no_spk }}</h1>
    <p>Status: {{ $spk->status }}</p>

    <table>
        <tr><td class="label">Customer</td><td>{{ $spk->customer }}</td></tr>
        <tr><td class="label">Item Code</td><td>{{ $spk->item_code }}</td></tr>
        <tr><td class="label">Part No/Information</td><td>{{ $spk->part_no }}</td></tr>
        <tr><td class="label">Model</td><td>{{ $spk->model }}</td></tr>
        <tr><td class="label">PO Number</td><td>{{ $spk->po_number }}</td></tr>
        <tr><td class="label">Size</td><td>{{ $spk->size }}</td></tr>
        <tr><td class="label">Color</td><td>{{ $spk->color }}</td></tr>
        <tr><td class="label">Order Quantity</td><td>{{ $spk->order_quantity }}</td></tr>
        <tr><td class="label">Stock Quantity</td><td>{{ $spk->stock_quantity }}</td></tr>
        <tr><td class="label">Production</td><td>{{ $spk->production }}</td></tr>
        <tr><td class="label">Material</td><td>{{ $spk->material }}</td></tr>
        <tr><td class="label">Diameter Core</td><td>{{ $spk->diameter_core }}</td></tr>
        <tr><td class="label">Packing</td><td>{{ $spk->packing }}</td></tr>
        <tr><td class="label">SPK Date</td><td>{{ $spk->spk_date ? \Illuminate\Support\Carbon::parse($spk->spk_date)->format('d/m/Y') : '-' }}</td></tr>
        <tr><td class="label">Order Date</td><td>{{ $spk->order_date ? \Illuminate\Support\Carbon::parse($spk->order_date)->format('d/m/Y') : '-' }}</td></tr>
        <tr><td class="label">Keterangan</td><td>{{ $spk->keterangan }}</td></tr>
    </table>
</body>
</html>
