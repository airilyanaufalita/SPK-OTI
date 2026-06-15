<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Data</title>
    <link rel="stylesheet" href="{{ asset('css/add-data.css') }}">
</head>
<body>

@include('layout.header')

<div class="page-content">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Add Data</h2>
        </div>

        <div class="card-body">
            <div class="form-grid">

                <div class="form-group">
                    <label>No SPK</label>
                    <input type="text">
                </div>

                <div class="form-group">
                    <label>Customer</label>
                    <input type="text">
                </div>

                <div class="form-group">
                    <label>Item Code</label>
                    <input type="text">
                </div>

                <div class="form-group">
                    <label>Part No/Information</label>
                    <input type="text">
                </div>

                <div class="form-group">
                    <label>Model</label>
                    <input type="text">
                </div>

                <div class="form-group">
                    <label>PO Number</label>
                    <input type="text">
                </div>

                <div class="form-group">
                    <label>Size</label>
                    <input type="text">
                </div>

                <div class="form-group">
                    <label>Color</label>
                    <input type="text">
                </div>

                <div class="form-group">
                    <label>Order Quantity</label>
                    <input type="text">
                </div>

                <div class="form-group">
                    <label>Stock Quantity</label>
                    <input type="text">
                </div>

                <div class="form-group">
                    <label>Production</label>
                    <input type="text">
                </div>

                <div class="form-group">
                    <label>Material</label>
                    <input type="text">
                </div>

                <div class="form-group">
                    <label>Diameter Core</label>
                    <input type="text">
                </div>

                <div class="form-group">
                    <label>Packing</label>
                    <input type="text">
                </div>

                <div class="form-group">
                    <label>SPK Date</label>
                    <input type="date">
                </div>

                <div class="form-group">
                    <label>Order Date</label>
                    <input type="date">
                </div>

                <div class="form-group form-full">
                    <label>Keterangan</label>
                    <textarea rows="4"></textarea>
                </div>

            </div>

            <div class="form-footer">
                <div style="position: relative;">
                    <button class="btn-status" onclick="toggleStatusDropdown()">
                        Status SPK
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9"/>
                        </svg>
                    </button>

                    <div class="status-dropdown" id="statusDropdown">
                        <div class="status-item">
                            <span class="label">Finished</span>
                            <span class="count">945</span>
                        </div>
                        <div class="status-item ongoing">
                            <span class="label">On Going</span>
                            <span class="count">97</span>
                        </div>
                        <div class="status-item pending">
                            <span class="label">Pending</span>
                            <span class="count">9</span>
                        </div>
                    </div>
                </div>

                <button class="btn-cancel"
                        onclick="window.location.href='{{ route('dashboard') }}'">
                    Cancel
                </button>
            
                <button class="btn-save"
                        onclick="window.location.href='{{ route('dashboard') }}'">
                    Save Changes
                </button>
            </div>
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
</script>

</body>
</html>