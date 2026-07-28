<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management SPK</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    @include('layout.header')

@if (session('success'))
    <div style="max-width:1200px;margin:12px auto 0;padding:10px 16px;background:#e6f6ec;color:#1a7f43;border-radius:8px;font-size:14px;">
        {{ session('success') }}
    </div>
@endif

<div class="top-bar">

    <div class="status-dropdown">
        <button class="status-btn" onclick="toggleDropdown()">
            <img src="{{ asset('images/repeat.png') }}" alt="Refresh" class="refresh-icon">
            <span>Status({{ $totalCount }})</span>
            <img src="{{ asset('images/down.png') }}" class="down-icon">
        </button>

        <div class="dropdown-menu hidden">
            <a href="{{ route('dashboard', array_merge(request()->except('page'), ['status' => 'Finished'])) }}" class="dropdown-item">
                <span>Finished</span>
                <span>{{ $statusCounts['Finished'] }}</span>
            </a>
            <a href="{{ route('dashboard', array_merge(request()->except('page'), ['status' => 'On Going'])) }}" class="dropdown-item">
                <span>On Going</span>
                <span>{{ $statusCounts['On Going'] }}</span>
            </a>
            <a href="{{ route('dashboard', array_merge(request()->except('page'), ['status' => 'Pending'])) }}" class="dropdown-item">
                <span>Pending</span>
                <span>{{ $statusCounts['Pending'] }}</span>
            </a>
            @if(request('status'))
                <a href="{{ route('dashboard', request()->except(['status', 'page'])) }}" class="dropdown-item">
                    <span>Tampilkan Semua</span>
                </a>
            @endif
        </div>
    </div>
    <div class="search-box">
        <form method="GET" action="{{ route('dashboard') }}">
            <input type="hidden" name="status" value="{{ request('status') }}">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Data">
        </form>
    </div>
</div>
    <div class="card">
        <div class="card-toolbar">
        <button class="add-btn" onclick="window.location.href='{{ route('add-data') }}'">
             <img src="{{ asset('images/add.png') }}" alt="Add" class="btn-icon">

             Add Data
        </button>
        <button class="filter-btn" onclick="toggleDropdown()">
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
        <tbody>
@forelse($spks as $spk)
<tr>
    <td>{{ $spk->no_spk }}</td>
    <td>{{ $spk->customer }}</td>
    <td>{{ $spk->item_code }}</td>
    <td>{{ $spk->order_quantity }}</td>
    <td>{{ $spk->spk_date ? \Illuminate\Support\Carbon::parse($spk->spk_date)->format('j/n/y') : '-' }}</td>
    <td>
        <span class="status-badge status-{{ $spk->status_slug }}">
            {{ $spk->status }}
        </span>
    </td>
    <td class="td-action">
        <div class="action-dropdown">
            <button class="dots-btn" onclick="toggleAction(this)">⋮</button>
            <div class="action-menu hidden">
                <a href="{{ route('spk.edit', $spk->id) }}" class="action-item">Edit</a>
                <a href="{{ route('spk.print', $spk->id) }}" target="_blank" class="action-item">Print</a>
                <form action="{{ route('spk.destroy', $spk->id) }}" method="POST"
                      onsubmit="return confirm('Hapus data {{ $spk->no_spk }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="action-item" style="all:unset;display:block;width:100%;box-sizing:border-box;cursor:pointer;">Delete</button>
                </form>
            </div>
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="7" style="text-align:center;padding:24px;">Tidak ada data.</td>
</tr>
@endforelse
        </tbody>
    </table>

           <div class="pagination-wrapper">
<p class="pagination-info">
    Showing {{ $spks->firstItem() ?? 0 }}-{{ $spks->lastItem() ?? 0 }} of {{ $spks->total() }} records
</p>
<div class="pagination-links">
    @php
        $lastPage = $spks->lastPage();
        $current = $spks->currentPage();
        $windowSize = 10;
        $start = max(1, $current - intdiv($windowSize, 2));
        $end = min($lastPage, $start + $windowSize - 1);
        $start = max(1, $end - $windowSize + 1);
    @endphp

    <a class="page-arrow" href="{{ $spks->previousPageUrl() ?? '#' }}"
       @if(!$spks->previousPageUrl()) style="opacity:.4;pointer-events:none;" @endif>‹</a>

    @for ($i = $start; $i <= $end; $i++)
        <a class="{{ $i == $current ? 'page-active' : '' }}" href="{{ $spks->url($i) }}">{{ $i }}</a>
    @endfor

    <a class="page-arrow" href="{{ $spks->nextPageUrl() ?? '#' }}"
       @if(!$spks->nextPageUrl()) style="opacity:.4;pointer-events:none;" @endif>›</a>
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
