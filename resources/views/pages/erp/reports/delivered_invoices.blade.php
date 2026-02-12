@extends('layout.erp.app')
@section('content')
<div class="container-fluid py-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Delivered Invoices</h4>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Order No</th>
                            <th>Customer</th>
                            <th class="text-end">Amount</th>
                            <th>Payment</th>
                            <th>Delivered At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->invoice_token }}</td>
                            <td>#{{ $order->order_no }}</td>
                            <td>{{ $order->customer->name ?? 'Walk-in' }}</td>
                            <td class="text-end">৳{{ number_format($order->total,2) }}</td>
                            <td>{{ strtoupper($order->payment_method) }}</td>
                            <td>{{ optional($order->updated_at)->format('M d, Y h:i A') }}</td>
                            <td>
                                <a href="{{ route('orders.invoice', $order->id) }}" class="btn btn-sm btn-outline-dark">View</a>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-secondary">Details</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No delivered invoices found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
