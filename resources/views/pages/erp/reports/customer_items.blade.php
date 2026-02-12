@extends('layout.erp.app')

@section('title', 'Customer Item Report')

@section('content')
<style>
    :root {
        --coral: #FF7F50;
    }

    .coral-text {
        color: var(--coral) !important;
    }

    .card {
        border: none;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        border-radius: 10px;
    }

    .card-header {
        background: white;
        border-bottom: 1px solid #eee;
        padding: 15px 20px;
    }
</style>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="text-dark"><i class="fas fa-chart-bar me-2 coral-text"></i>Customer Item Report</h3>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Purchased Items Log</h5>
            <div>
                {{-- Optional: Export buttons or filters could go here --}}
            </div>
        </div>
        <div class="card-body">
            @if($orderItems->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                <p class="text-muted">No purchase records found.</p>
            </div>
            @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th>Date</th>
                            <th>Order No</th>
                            <th>Customer</th>
                            <th>Item</th>
                            <th class="text-center">Qty</th>
                            <th class="text-end">Unit Price</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderItems as $item)
                        <tr>
                            <td>{{ $item->created_at->format('d M, Y') }}</td>
                            <td>
                                <a href="{{ $item->order ? route('orders.show', $item->order_id) : '#' }}" class="text-decoration-none coral-text">
                                    {{ $item->order?->order_no ?? 'N/A' }}
                                </a>
                            </td>
                            <td>
                                {{ $item->order?->customer?->name ?? 'Walk-in Customer' }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($item->menu && $item->menu->photo)
                                    <img src="{{ asset('uploads/menus/'.$item->menu->photo) }}"
                                        class="rounded me-2" style="width: 30px; height: 30px; object-fit: cover;">
                                    @endif
                                    {{ $item->menu->name ?? 'Unknown Item' }}
                                </div>
                            </td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-end">${{ number_format($item->unit_price, 2) }}</td>
                            <td class="text-end fw-bold">${{ number_format($item->total_price, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $orderItems->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection