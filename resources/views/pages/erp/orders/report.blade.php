@extends('layout.erp.app')

@section('content')

<!DOCTYPE html>
<html>
<head>
    <title>Customer Item Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>

@php
    $isFiltered = request()->hasAny(['customer_id', 'from', 'to']);
@endphp

<div class="container mt-4">

    <!-- ================= HEADER ================= -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Customer Order Report</h3>

        @if($isFiltered)
            <button onclick="window.print()" class="btn no-print" style="background:#FF7F50">
                Print Customer Order
            </button>
        @endif
    </div>

    <!-- ================= FILTER FORM (FIRST LOAD ONLY) ================= -->
    @if(!$isFiltered)
        <form method="GET" class="card mb-4 no-print">
            <div class="card-header" style="background:#FF7F50">
                <strong>Filter Report</strong>
            </div>

            <div class="card-body row g-3">
                <div class="col-md-4">
                    <label class="form-label">Customer</label>
                    <select name="customer_id" class="form-select" required>
                        <option value="">Select Customer</option>
                        @foreach($customers as $cust)
                            <option value="{{ $cust->id }}">
                                {{ $cust->name }} ({{ $cust->phone }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">From Date</label>
                    <input type="date" name="from" class="form-control">
                </div>

                <div class="col-md-4">
                    <label class="form-label">To Date</label>
                    <input type="date" name="to" class="form-control">
                </div>

                <div class="col-md-12 text-end">
                    <button class="btn btn-warning px-4">
                        Generate Report
                    </button>
                </div>
            </div>
        </form>

        <!-- Welcome Message -->
        <div class="card text-center py-5 no-print">
            <h5 class="text-muted">
                Please select customer & date range to generate report
            </h5>
        </div>
    @endif

    <!-- ================= REPORT SECTION ================= -->
    @if($isFiltered && request('customer_id') && isset($customer))

        <!-- Back Button -->
        <a href="{{ route('reports.customer.items') }}"
           class="btn mb-3 no-print" style="background:#FF7F50">
            ← Back Filter
        </a>

        <!-- Date Info -->
        @if($from || $to)
            <p class="text-muted">
                <strong>Order Date:</strong>
                {{ $from ?? 'N/A' }} to {{ $to ?? 'N/A' }}
            </p>
        @endif

        <!-- Customer Info -->
        <div class="card mb-4">
            <div class="card-header" style="background:#FF7F50">
                <strong>Customer Information</strong>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $customer->name }}</p>
                <p><strong>Phone:</strong> {{ $customer->phone ?? 'N/A' }}</p>
                <p><strong>Email:</strong> {{ $customer->email ?? 'N/A' }}</p>
            </div>
        </div>

        <!-- Item Report -->
        <div class="card">
            <div class="card-header" style="background:#FF7F50">
                <strong>Ordered Items Summary</strong>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Item Name</th>
                        <th class="text-center">Total Quantity</th>
                        <th class="text-end">Total Amount</th>
                    </tr>
                    </thead>

                    <tbody>
                    @php $grandTotal = 0; @endphp

                    @forelse($items as $group)
                        @php
                            $qty = $group->sum('quantity');
                            $amount = $group->sum('total_price');
                            $grandTotal += $amount;
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $group->first()->menu->name ?? 'N/A' }}</td>
                            <td class="text-center">{{ $qty }}</td>
                            <td class="text-end">৳{{ number_format($amount,2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                No order data found
                            </td>
                        </tr>
                    @endforelse
                    </tbody>

                    <tfoot>
                    <tr class="table-active">
                        <th colspan="3" class="text-end">Grand Total</th>
                        <th class="text-end">
                            ৳{{ number_format($grandTotal,2) }}
                        </th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    @endif

</div>

</body>
</html>


@endsection
