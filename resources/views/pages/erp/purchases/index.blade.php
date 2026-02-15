@extends('layout.erp.app')

@section('dashboard')
Welcome to Abir's FoodCourt
@endsection
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
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .container-fluid {
        max-width: 1400px;
        padding: 20px;
    }

    /* Page Header */
    .page-header {
        background: white;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(255, 127, 80, 0.1);
        border-left: 5px solid var(--coral);
        margin-bottom: 25px;
    }

    .page-title {
        color: #333;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .page-subtitle {
        color: #666;
        font-size: 14px;
    }

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

    .btn-create {
        background: var(--coral);
        color: white;
    }

    .btn-warning {
        background: #ffc107;
        color: #212529;
    }

    /* Stats Cards */
    .stats-card {
        background: white;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        border-top: 4px solid;
        margin-bottom: 20px;
    }

    .stats-draft { border-color: #ffc107; }
    .stats-approved { border-color: #28a745; }
    .stats-received { border-color: #17a2b8; }
    .stats-total { border-color: var(--coral); }

    .stats-value {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .stats-label {
        font-size: 13px;
        color: #666;
        text-transform: uppercase;
        font-weight: 600;
    }

    /* Table */
    .table-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 3px 15px rgba(0,0,0,0.05);
    }

    .table-header {
        background: linear-gradient(90deg, #FFF5F2 0%, #FFE8E0 100%);
        padding: 20px;
        border-bottom: 2px solid var(--coral-border);
    }

    .table-title {
        color: var(--coral);
        font-weight: 600;
        margin: 0;
    }

    .table {
        margin: 0;
    }

    .table thead th {
        background: #f8f9fa;
        padding: 15px;
        font-weight: 600;
        color: #666;
        border-bottom: 2px solid var(--coral-border);
        text-transform: uppercase;
        font-size: 13px;
    }

    .table tbody td {
        padding: 15px;
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
    }

    .table tbody tr:hover {
        background: #FFF9F7;
    }

    /* Status Badge */
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .badge-draft { background: #FFF3CD; color: #856404; }
    .badge-approved { background: #D4EDDA; color: #155724; }
    .badge-received { background: #D1ECF1; color: #0C5460; }

    /* Action Buttons in Table */
    .btn-action {
        padding: 6px 12px;
        border-radius: 6px;
        border: none;
        font-size: 12px;
        transition: all 0.3s;
    }

    .btn-action:hover {
        transform: translateY(-2px);
    }

    .btn-view { background: #17a2b8; color: white; }
    .btn-edit { background: #007bff; color: white; }
    .btn-delete { background: #dc3545; color: white; }
    .btn-receive { background: #28a745; color: white; }

    /* Amount */
    .amount {
        font-weight: 600;
        color: #333;
        font-family: 'Courier New', monospace;
    }

    /* Pagination */
    .pagination {
        margin: 0;
        padding: 20px;
        background: white;
        border-top: 1px solid #f0f0f0;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 50px 20px;
        color: #666;
    }

    .empty-state i {
        font-size: 50px;
        color: #ddd;
        margin-bottom: 20px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .table-header {
            flex-direction: column;
            gap: 10px;
        }

        .action-buttons {
            width: 100%;
            justify-content: flex-start;
        }

        .table thead th, .table tbody td {
            padding: 10px;
            font-size: 12px;
        }
    }
</style>

<div class="container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h2 class="page-title">Purchase Orders</h2>
                <p class="page-subtitle">Manage all purchase orders in one place</p>
            </div>
            <div class="action-buttons d-flex gap-2">
                <a href="{{ route('purchases.create') }}" class="action-btn btn-create">
                    <i class="fas fa-plus"></i> Create Purchase
                </a>
                <a href="{{ route('purchases.low-stock') }}" class="action-btn btn-warning">
                    <i class="fas fa-exclamation-triangle"></i> Low Stock
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="stats-card stats-total">
                <div class="stats-value">{{ $purchases->total() }}</div>
                <div class="stats-label">Total Orders</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stats-card stats-draft">
                <div class="stats-value">{{ $purchases->where('status', 'draft')->count() }}</div>
                <div class="stats-label">Draft</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stats-card stats-approved">
                <div class="stats-value">{{ $purchases->where('status', 'approved')->count() }}</div>
                <div class="stats-label">Approved</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stats-card stats-received">
                <div class="stats-value">{{ $purchases->where('status', 'received')->count() }}</div>
                <div class="stats-label">Received</div>
            </div>
        </div>
    </div>

    <!-- Purchase Orders Table -->
    <div class="table-card">
        <div class="table-header">
            <h5 class="table-title">
                <i class="fas fa-list me-2"></i> All Purchase Orders
            </h5>
        </div>

        @if($purchases->count() > 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>PO Number</th>
                        <th>Supplier</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Total Amount</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($purchases as $purchase)
                    <tr>
                        <td>
                            <strong>{{ $purchase->po_number }}</strong>
                        </td>
                        <td>{{ $purchase->supplier->name }}</td>
                        <td>{{ $purchase->order_date->format('d M Y') }}</td>
                        <td>
                            <span class="status-badge badge-{{ $purchase->status }}">
                                {{ ucfirst($purchase->status) }}
                            </span>
                        </td>
                        <td class="amount">৳{{ number_format($purchase->grand_total, 2) }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <!-- View Button - Always Visible -->
                                <a href="{{ route('purchases.show', $purchase->id) }}" class="btn-action btn-view" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <!-- Edit Button - Only for Draft Status -->
                                @if($purchase->status == 'draft')
                                <a href="{{ route('purchases.edit', $purchase->id) }}" class="btn-action btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endif

                                <!-- Approve/Receive Buttons - Based on Status -->
                                @if($purchase->status == 'draft')
                                <form action="{{ route('purchases.approve', $purchase->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn-action btn-receive"
                                        title="Approve Order"
                                        onclick="return confirm('Approve this purchase order?')">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                @endif

                                {{-- @if($purchase->status == 'approved')
                                <button class="btn-action btn-receive" title="Receive Items"
                                    onclick="alert('Receive functionality will be added soon!')">
                                    <i class="fas fa-truck"></i>
                                </button>
                                @endif --}}

                                <!-- Delete Button - Only for Draft Status -->
                                {{-- @if($purchase->status == 'draft')
                                <form action="{{ route('purchases.destroy', $purchase->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete"
                                        title="Delete"
                                        onclick="return confirm('Are you sure to delete this purchase order?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endif --}}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            {{ $purchases->links() }}
        </div>

        @else
        <!-- Empty State -->
        <div class="empty-state">
            <i class="fas fa-shopping-cart"></i>
            <h4>No Purchase Orders Found</h4>
            <p>Create your first purchase order to get started</p>
            <a href="{{ route('purchases.create') }}" class="action-btn btn-create mt-3">
                <i class="fas fa-plus"></i> Create Purchase Order
            </a>
        </div>
        @endif
    </div>

</div>

@endsection
