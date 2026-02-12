@extends('layout.erp.app')

@section('title', 'Purchase Order - ' . $purchase->po_number)

@section('content')

<style>
    /* Coral Theme */
    :root {
        --coral: #FF7F50;
        --coral-light: #FFB6A1;
        --coral-bg: #FFF5F2;
        --coral-border: #FFD7C8;
    }

    body {
        background: linear-gradient(135deg, #FFF5F2 0%, #FFE8E0 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Container */
    .container {
        max-width: 1200px;
        padding: 20px;
    }

    /* Header */
    .po-header {
        background: white;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(255, 127, 80, 0.1);
        border-left: 5px solid var(--coral);
        margin-bottom: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .po-title h2 {
        color: #333;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .po-number {
        color: var(--coral);
        font-weight: 600;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Status Badge */
    .status-badge {
        padding: 8px 20px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
    }

    .draft { background: #FFF3CD; color: #856404; }
    .approved { background: #D4EDDA; color: #155724; }
    .received { background: #D1ECF1; color: #0C5460; }

    /* Action Buttons */
    .action-btn {
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 500;
        border: none;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .btn-back {
        background: #6c757d;
        color: white;
    }

    .btn-edit {
        background: var(--coral);
        color: white;
    }

    .btn-approve {
        background: #28a745;
        color: white;
    }

    /* Cards */
    .info-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        border: 1px solid #f0f0f0;
    }

    .card-title {
        color: var(--coral);
        font-weight: 600;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--coral-border);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Info Grid */
    .info-grid {
        display: grid;
        gap: 15px;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px dashed #eee;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-label {
        color: #666;
        font-weight: 500;
    }

    .info-value {
        color: #333;
        font-weight: 600;
        text-align: right;
    }

    /* Supplier Box */
    .supplier-box {
        background: linear-gradient(135deg, #FFF5F2 0%, #FFE8E0 100%);
        padding: 15px;
        border-radius: 8px;
        border-left: 4px solid var(--coral);
        margin-top: 5px;
    }

    .supplier-name {
        font-size: 18px;
        font-weight: 700;
        color: #333;
        margin-bottom: 5px;
    }

    /* Financial Summary */
    .financial-item {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .financial-item:last-child {
        border-bottom: none;
    }

    .grand-total {
        background: var(--coral-bg);
        padding: 15px;
        border-radius: 8px;
        margin-top: 10px;
        border-left: 4px solid var(--coral);
    }

    .grand-total .info-value {
        font-size: 20px;
        color: var(--coral);
    }

    /* Items Table */
    .table-container {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }

    .table-header {
        background: linear-gradient(90deg, #FFF5F2 0%, #FFE8E0 100%);
        padding: 18px 25px;
        border-bottom: 2px solid var(--coral-border);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-title {
        color: var(--coral);
        font-weight: 600;
        margin: 0;
    }

    .table-badge {
        background: var(--coral);
        color: white;
        padding: 4px 12px;
        border-radius: 15px;
        font-size: 12px;
        font-weight: 600;
    }

    .table {
        width: 100%;
        margin: 0;
    }

    .table th {
        background: #f8f9fa;
        padding: 15px;
        font-weight: 600;
        color: #666;
        border-bottom: 2px solid var(--coral-border);
        text-transform: uppercase;
        font-size: 13px;
    }

    .table td {
        padding: 15px;
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
    }

    .table tr:last-child td {
        border-bottom: none;
    }

    .table tr:hover {
        background: #FFF9F7;
    }

    /* Quantity Badges */
    .qty-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        text-align: center;
        min-width: 50px;
    }

    .qty-ordered { background: #E3F2FD; color: #1565C0; }
    .qty-received { background: #E8F5E9; color: #2E7D32; }
    .qty-pending { background: #FFF3E0; color: #EF6C00; }

    /* Product Info */
    .product-name {
        font-weight: 600;
        color: #333;
        margin-bottom: 3px;
    }

    .product-sku {
        font-size: 12px;
        color: #888;
    }

    /* Amount */
    .amount {
        font-weight: 600;
        color: #333;
        font-family: 'Courier New', monospace;
    }

    .total-amount {
        color: var(--coral);
        font-weight: 700;
    }

    /* Table Footer */
    .table-footer {
        background: #f8f9fa;
        padding: 15px 25px;
        border-top: 2px solid var(--coral-border);
        text-align: right;
    }

    .subtotal {
        font-size: 16px;
        font-weight: 600;
        color: var(--coral);
    }

    /* Notes */
    .notes-box {
        background: white;
        border-radius: 12px;
        padding: 25px;
        margin-top: 20px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        border-left: 4px solid var(--coral);
    }

    .notes-content {
        background: #f9f9f9;
        padding: 15px;
        border-radius: 8px;
        line-height: 1.6;
        color: #555;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .po-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .action-buttons {
            width: 100%;
        }

        .table-header {
            flex-direction: column;
            gap: 10px;
            align-items: flex-start;
        }

        .table th, .table td {
            padding: 10px;
            font-size: 12px;
        }

        .info-item {
            flex-direction: column;
            gap: 5px;
        }

        .info-value {
            text-align: left;
        }
    }
</style>

<div class="container">

    <!-- Header -->
    <div class="po-header">
        <div class="po-title">
            <h2>Purchase Order Details</h2>
            <div class="po-number">
                <i class="fas fa-file-invoice"></i>
                PO #{{ $purchase->po_number }}
            </div>
        </div>

        <div class="status-section">
            <div class="order-date mb-2">
                <small class="text-muted">
                    <i class="far fa-calendar"></i> {{ $purchase->order_date->format('d M Y') }}
                </small>
            </div>
            <div class="status-badge {{ $purchase->status }}">
                {{ ucfirst($purchase->status) }}
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="d-flex gap-3 mb-4 flex-wrap">
        <a href="{{ route('purchases.index') }}" class="action-btn btn-back">
            <i class="fas fa-arrow-left"></i> Back
        </a>

        @if($purchase->status === 'draft')
            <a href="{{ route('purchases.edit', $purchase->id) }}" class="action-btn btn-edit">
                <i class="fas fa-edit"></i> Edit
            </a>

            <form action="{{ route('purchases.approve', $purchase->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="action-btn btn-approve"
                    onclick="return confirm('Approve this purchase order?')">
                    <i class="fas fa-check"></i> Approve
                </button>
            </form>
        @endif

        <button onclick="window.print()" class="action-btn" style="background: #6c757d; color: white;">
            <i class="fas fa-print"></i> Print
        </button>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-4">

            <!-- Order Information -->
            <div class="info-card">
                <div class="card-title">
                    <i class="fas fa-info-circle"></i> Order Info
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Supplier</span>
                        <span class="info-value">
                            <div class="supplier-box">
                                <div class="supplier-name">{{ $purchase->supplier->name }}</div>
                                <small>ID: {{ $purchase->supplier->id }}</small>
                            </div>
                        </span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Order Date</span>
                        <span class="info-value">{{ $purchase->order_date->format('d M Y') }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Expected Delivery</span>
                        <span class="info-value">
                            @if($purchase->expected_delivery_date)
                                {{ $purchase->expected_delivery_date->format('d M Y') }}
                            @else
                                <span class="text-muted">Not set</span>
                            @endif
                        </span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Actual Delivery</span>
                        <span class="info-value">
                            @if($purchase->delivery_date)
                                <span class="text-success">
                                    <i class="fas fa-check-circle"></i> {{ $purchase->delivery_date->format('d M Y') }}
                                </span>
                            @else
                                <span class="text-muted">Pending</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Financial Summary -->
            <div class="info-card">
                <div class="card-title">
                    <i class="fas fa-calculator"></i> Financial Summary
                </div>
                <div class="info-grid">
                    <div class="financial-item">
                        <span class="info-label">Subtotal</span>
                        <span class="info-value">৳ {{ number_format($purchase->subtotal ?? 0, 2) }}</span>
                    </div>

                    @if(($purchase->tax ?? 0) > 0)
                    <div class="financial-item">
                        <span class="info-label">Tax/VAT</span>
                        <span class="info-value">৳ {{ number_format($purchase->tax ?? 0, 2) }}</span>
                    </div>
                    @endif

                    @if(($purchase->shipping ?? 0) > 0)
                    <div class="financial-item">
                        <span class="info-label">Shipping</span>
                        <span class="info-value">৳ {{ number_format($purchase->shipping ?? 0, 2) }}</span>
                    </div>
                    @endif

                    @if(($purchase->discount ?? 0) > 0)
                    <div class="financial-item">
                        <span class="info-label">Discount</span>
                        <span class="info-value text-success">-৳ {{ number_format($purchase->discount ?? 0, 2) }}</span>
                    </div>
                    @endif

                    <div class="grand-total">
                        <div class="financial-item">
                            <span class="info-label">Grand Total</span>
                            <span class="info-value">৳ {{ number_format($purchase->grand_total ?? 0, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column -->
        <div class="col-lg-8">

            <!-- Order Items -->
            <div class="table-container">
                <div class="table-header">
                    <h6 class="table-title">
                        <i class="fas fa-shopping-cart me-2"></i> Order Items
                    </h6>
                    <div>
                        <span class="table-badge me-2">{{ $purchase->items->count() }} items</span>
                        <small class="text-muted">Total Qty: {{ $purchase->items->sum('quantity') }}</small>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th class="text-center">Ordered</th>
                                <th class="text-center">Received</th>
                                <th class="text-center">Pending</th>
                                <th class="text-end">Unit Price</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purchase->items as $item)
                                @php
                                    $pending = $item->quantity - $item->received_quantity;
                                @endphp
                                <tr>
                                    <td class="text-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="product-name">{{ $item->product->name }}</div>
                                        <div class="product-sku">{{ $item->product->sku ?? 'N/A' }}</div>
                                    </td>
                                    <td class="text-center">
                                        <span class="qty-badge qty-ordered">{{ $item->quantity }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="qty-badge qty-received">{{ $item->received_quantity }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="qty-badge qty-pending">{{ max(0, $pending) }}</span>
                                    </td>
                                    <td class="text-end amount">৳ {{ number_format($item->unit_price, 2) }}</td>
                                    <td class="text-end total-amount">৳ {{ number_format($item->total_price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="table-footer">
                    <div class="subtotal">
                        Subtotal: ৳ {{ number_format($purchase->subtotal ?? 0, 2) }}
                    </div>
                </div>
            </div>

            <!-- Notes -->
            @if($purchase->notes)
            <div class="notes-box">
                <div class="card-title">
                    <i class="fas fa-sticky-note"></i> Notes
                </div>
                <div class="notes-content">
                    {{ $purchase->notes }}
                </div>
            </div>
            @endif

        </div>
    </div>

</div>

@endsection
