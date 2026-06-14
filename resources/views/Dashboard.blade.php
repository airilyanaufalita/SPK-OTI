<!DOCTYPE html>
<html lanng="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management SPK</title>

    @vite([
    'resources/css/dashboard.css'
    ])
</head>
<body>
    <header class="header">
    <div class="header-left">
    <img src="{{ asset('images/logo.OTI.jpg') }}" alt="Logo" class="logo">
    <h1>Management SPK</h1>
    </div>

    <div class="header-right">
    <img src="{{ asset('images/vaadin_office.png') }}" alt="Building" class="building-icon">
    <h2>PT. Ohtomi Teknologi Indonesia</h2>
    </div>

</header>
<div class="top-bar">

    <div class="status-dropdown">
        <button class="status-btn" onclick="toggleDropdown()">
            <img src="{{ asset('images/repeat.png') }}" alt="Refresh" class="refresh-icon">
            <span>Status(1013)</span>
            <img src="{{ asset('images/down.png') }}" class="down-icon">
        </button>

        <div class="dropdown-menu hidden">
            <div class="dropdown-item">
                <span>Finished</span>
                <span>945</span>
            </div>
            <div class="dropdown-item">
                <span>On Going</span>
                <span>95</span>
            </div>
            <div class="dropdown-item">
                <span>Pending</span>
                <span>9</span>
            </div>
        </div>
    </div>
    <div class="search-box">
        <input type="text" placeholder="Search Data">
    </div>
</div>
    <div class="card">
        <div class="card-toolbar">
        <button class="add-btn">
             <img src="{{ asset('images/add.png') }}" alt="Add" class="btn-icon">
             Add Data
        </button>
        <button class="filter-btn">
            <img src="{{ asset('images/filter.png') }}" alt="Filter" class="btn-icon">
            Filter
        </button>
    </div>
<div class="table-wrappper">
    <table class="spk-table">
        <thead>
            <tr>
                <th>No SPK</th>
                <th>Customer</th>
                <th>Item Code</th>
                <th>Quantity</th>
                <th>Date</th>
                <th>Status</th>
                <th class="th-action">
                    <img src="{{ asset('images/eye.png') }}" alt="View" class="th-icon">
                </th>
            </tr>
        </thead>
        @php
$spkList = [
    ['no_spk' => 'A0001', 'customer' => 'Panasonic', 'item_code' => 'A0034', 'quantity' => '3.000', 'date' => '18/6/26', 'status' => 'On Going'],
    ['no_spk' => 'A0001', 'customer' => 'Panasonic', 'item_code' => 'A0034', 'quantity' => '3.000', 'date' => '18/6/26', 'status' => 'Finished'],
    ['no_spk' => 'A0001', 'customer' => 'Panasonic', 'item_code' => 'A0034', 'quantity' => '3.000', 'date' => '18/6/26', 'status' => 'Finished'],
    ['no_spk' => 'A0001', 'customer' => 'Panasonic', 'item_code' => 'A0034', 'quantity' => '3.000', 'date' => '18/6/26', 'status' => 'Pending'],
    ['no_spk' => 'A0001', 'customer' => 'Panasonic', 'item_code' => 'A0034', 'quantity' => '3.000', 'date' => '18/6/26', 'status' => 'Pending'],
    ['no_spk' => 'A0001', 'customer' => 'Panasonic', 'item_code' => 'A0034', 'quantity' => '3.000', 'date' => '18/6/26', 'status' => 'On Going'],
    ['no_spk' => 'A0001', 'customer' => 'Panasonic', 'item_code' => 'A0034', 'quantity' => '3.000', 'date' => '18/6/26', 'status' => 'Finished'],
];
@endphp
        <tbody>
@foreach($spkList as $spk)
<tr>
    <td>{{ $spk['no_spk'] }}</td>
    <td>{{ $spk['customer'] }}</td>
    <td>{{ $spk['item_code'] }}</td>
    <td>{{ $spk['quantity'] }}</td>
    <td>{{ $spk['date'] }}</td>
    <td>
        <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $spk['status'])) }}">
            {{ $spk['status'] }}
        </span>
    </td>
    <td class="td-action">
        <div class="action-dropdown">
            <button class="dots-btn" onclick="toggleAction(this)">⋮</button>
            <div class="action-menu hidden">
                <div class="action-item">Edit</div>
                <div class="action-item">Print</div>
                <div class="action-item">Delete</div>
            </div>
        </div>
    </td>
</tr>
@endforeach
        </tbody>
    </table>

           <div class="pagination-wrapper">
<p class="pagination-info">Showing 1-10 of 945 records</p>
<div class="pagination-links">
    <span>‹</span>
    <span class="page-active">1</span>
    <span>2</span>
    <span>3</span>
    <span>4</span>
    <span>5</span>
    <span>6</span>
    <span>7</span>
    <span>8</span>
    <span>9</span>
    <span>10</span>
    <span>Next</span>
    <span>›</span>
</div>
        </div>
    
</div>

<script>
    function toggleDropdown() {
        const menu = document.querySelector('.dropdown-menu');
        menu.classList.toggle('hidden');

    }
    document.addEventListener('click', function(e){
        const dropdown=document.querySelector('.status-dropdown');
        if (!dropdown.contains(e.target)) {
            document.querySelector('.dropdown-menu').classList.add('hidden');
        }
    });
    function toggleAction(btn) {
    const menu = btn.nextElementSibling;
    document.querySelectorAll('.action-menu').forEach(m => {
        if (m !== menu) m.classList.add('hidden');
    });
    menu.classList.toggle('hidden');
}

document.addEventListener('click', function(e) {
    if (!e.target.closest('.action-dropdown')) {
        document.querySelectorAll('.action-menu').forEach(m => m.classList.add('hidden'));
    }
});
</script>
</body>
</html>