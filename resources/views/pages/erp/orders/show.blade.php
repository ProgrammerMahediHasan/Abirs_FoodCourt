<!DOCTYPE html>
<html>
<head>
    <title>Order #{{ $order->order_no }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">

       <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Order #{{ $order->order_no }}</h2>

    <div>
        <a
            onclick="window.print()"
            class="btn"
            style="background-color: #FF7F50; border: 1px solid #FF7F50; border-radius: 4px; padding: 8px 16px; margin-right: 10px; text-decoration: none;"
        >
             Print Orders
        </a>
        <a
            href="{{ route('orders.index') }}"
            class="btn"
            style="background-color: #FF7F50; border: 1px solid #FF7F50; border-radius: 4px; padding: 8px 16px; text-decoration: none;"
        >
            ← Back to Orders
        </a>
    </div>

</div>

        <div class="row">
            <!-- Order Info -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header" style="background:#FF7F50; color:#000">
                        <h5 class="mb-0">Order Information</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th width="40%">Order Number:</th>
                                <td>{{ $order->order_no }}</td>
                            </tr>
                            <tr>
                                <th>Customer:</th>
                                <td>{{ $order->customer->name ?? 'Walk-in Customer' }}</td>
                            </tr>
                            <tr>
                                <th>Restaurant:</th>
                                <td>{{ $order->restaurant->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Order Type:</th>
                                <td>{{ ucfirst($order->order_type) }}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : 'success' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Order Date:</th>
                                <td>{{ $order->ordered_at->format('d F Y, h:i A') }}</td>
                            </tr>
                            <tr>
                                <th>Note:</th>
                                <td>{{ $order->note ?? 'No special instructions' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Payment Summary -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header" style="background:#FF7F50; color:#000;">
                        <h5 class="mb-0">Payment Summary</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th>Subtotal:</th>
                                <td class="text-end">৳{{ number_format($order->subtotal, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Tax (10%):</th>
                                <td class="text-end">৳{{ number_format($order->tax, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Discount:</th>
                                <td class="text-end">৳{{ number_format($order->discount, 2) }}</td>
                            </tr>
                            <tr class="table-active">
                                <th><h5 class="mb-0">Total Amount:</h5></th>
                                <td class="text-end"><h5 class="mb-0">৳{{ number_format($order->total, 2) }}</h5></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="card">
            <div class="card-header" >
                <h5 class="mb-0" >Menu Item to your orders </h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="background:#FF7F50; color:#000;">SL</th>
                            <th style="background:#FF7F50; color:#000;">Menu Item</th>
                            <th style="background:#FF7F50; color:#000;" class="text-center">Quantity</th>
                            <th style="background:#FF7F50; color:#000;" class="text-end">Unit Price</th>
                            <th style="background:#FF7F50; color:#000;" class="text-end">Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->menu->name ?? 'N/A' }}</td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-end">৳{{ number_format($item->unit_price, 2) }}</td>
                            <td class="text-end">৳{{ number_format($item->total_price, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- <div class="mt-3 text-center">
            <button onclick="window.print()" class="btn btn-primary">Print Invoice</button>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
        </div> --}}
    </div>
</body>
</html>
