@extends('layout.erp.app')
@section('dashboard')
Welcome to Abir's FoodCourt
@endsection
@section('content')
<style>
    :root {
        --coral: #FF7F50;
        --coral-light: #ffede8;
        --coral-dark: #e66b42;
    }
    .coral-bg { background-color: var(--coral) !important; color: white !important; }
    .coral-text { color: var(--coral) !important; }
    .btn-coral { background-color: var(--coral); color: white; border: none; transition: all 0.3s; }
    .btn-coral:hover { background-color: var(--coral-dark); color: white; }
    .status-badge { padding: 4px 10px; border-radius: 12px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; }
    .status-pending { background-color: #fff3cd; color: #856404; border: 1px solid #ffeaa7; }
    .status-confirmed { background-color: #d1ecf1; color: #0c5460; border: 1px solid #bee5eb; }
    .status-preparing { background-color: #cce5ff; color: #004085; border: 1px solid #b8daff; }
    .status-ready { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
    .status-delivered { background-color: #28a745; color: white; border: 1px solid #218838; }
    .status-cancelled { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
</style>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h3 class="text-dark"><i class="fas fa-shopping-cart me-2 coral-text"></i>Order Management</h3>
            <a href="{{ route('orders.create') }}" class="btn-coral btn"><i class="fas fa-plus-circle me-2"></i>New Order</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    @if($orders->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
            <h4>No orders found</h4>
            <p class="text-muted">Create your first order to get started</p>
            <a href="{{ route('orders.create') }}" class="btn-coral btn"><i class="fas fa-plus-circle me-2"></i>Create Order</a>
        </div>
    @else
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="coral-bg">
                <tr>
                    <th>ORDER NO</th>
                    <th>CUSTOMER</th>
                    <th>ITEMS</th>
                    <th>AMOUNT</th>
                    <th>STATUS</th>
                    <th>TIME</th>
                    <th class="text-center">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>#{{ $order->order_no }}</td>
                    <td>{{ $order->customer->name ?? 'Walk-in' }}</td>
                    <td>{{ $order->items_count ?? $order->items->count() }}</td>
                    <td>৳{{ number_format($order->total,2) }}</td>
                    <td><span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span></td>
                    <td>{{ $order->ordered_at->format('M d, Y h:i A') }}</td>
                    <td class="text-center">
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info btn-sm" title="View Order"><i class="fas fa-eye"></i></a>

                        @if($order->status == 'pending')
                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-success btn-sm" title="Approve Order">
                                <i class="fas fa-check-circle"></i>
                            </a>
                        @endif

                        @if($order->status == 'confirmed')
                            <a href="{{ route('orders.payment.form', $order->id) }}" class="btn btn-warning btn-sm" title="Make Payment">
                                <i class="fas fa-money-bill-wave"></i>
                            </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $orders->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
