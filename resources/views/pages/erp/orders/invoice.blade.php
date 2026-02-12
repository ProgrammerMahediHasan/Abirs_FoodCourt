@extends('layout.erp.app')
@section('content')
<div class="container d-flex justify-content-center p-4">
    <div id="invoiceContent" style="
        font-family: 'Courier New', monospace;
        width: 450px;
        background: white;
        padding: 20px;
        border: 1px solid #ddd;
    ">
        <!-- Header -->
        <div style="text-align: center; margin-bottom: 20px;">
            <h2 style="color: #FF7F50; font-weight: 700; margin-bottom: 5px;">Abir's FoodCourt</h2>
            <p style="margin: 0; font-size: 14px; color: #555;">
                Dhaka, Demra, 1205<br>
                Phone: +880123456789 <br>
                Email: info@abirsfoodcourt.com
            </p>

            <div style="margin: 10px 0; border-top: 2px dashed #000;"></div>

            <div style="font-size: 18px; font-weight: bold;">PAYMENT RECEIPT</div>
            <div style="border-top: 2px dashed #000; margin: 10px 0;"></div>
        </div>

        <!-- Invoice Details -->
        <table style="width: 100%; margin-bottom: 15px; font-family: 'Courier New', monospace;">
            <tr>
                <td style="width: 30%; padding: 3px 0;"><strong>Inv-No:</strong></td>
                <td style="padding: 3px 0;">{{ $order->invoice_token }}</td>
            </tr>
            <tr>
                <td style="padding: 3px 0;"><strong>Inv-Date:</strong></td>
                <td style="padding: 3px 0;">{{ now()->setTimezone('Asia/Dhaka')->format('d-m-Y h:i:s A') }}</td>
            </tr>
            <tr>
                <td style="padding: 3px 0;"><strong>Order-Date:</strong></td>
                <td style="padding: 3px 0;">{{ $order->ordered_at->format('d-m-Y h:i:s A') }}</td>
            </tr>
            <tr>
                <td style="padding: 3px 0;"><strong>Cashier:</strong></td>
                <td style="padding: 3px 0;">{{ Auth::user()->name ?? 'Admin' }}</td>
            </tr>
            <tr>
                <td style="padding: 3px 0;"><strong>Payment:</strong></td>
                <td style="padding: 3px 0;"><strong>{{ strtoupper($order->payment_method) }}</strong></td>
            </tr>
        </table>

        <div style="border-top: 2px dashed #000; margin: 15px 0;"></div>

        <!-- Items Table -->
        <table style="width: 100%; margin-bottom: 15px; border-collapse: collapse; font-family: 'Courier New', monospace;">
            <thead>
                <tr style="border-bottom: 2px solid #000;">
                    <th style="text-align: left; padding: 8px 0; width: 50%;">Item</th>
                    <th style="text-align: center; padding: 8px 0; width: 15%;">Qty</th>
                    <th style="text-align: right; padding: 8px 0; width: 17.5%;">Price</th>
                    <th style="text-align: right; padding: 8px 0; width: 17.5%;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr style="border-bottom: 1px dotted #ddd;">
                    <td style="padding: 8px 0; vertical-align: top;">{{ $item->menu->name }}</td>
                    <td style="text-align: center; padding: 8px 0; vertical-align: top;">{{ $item->quantity }}</td>
                    <td style="text-align: right; padding: 8px 0; vertical-align: top;">{{ number_format($item->unit_price,2) }}</td>
                    <td style="text-align: right; padding: 8px 0; vertical-align: top; font-weight: bold;">{{ number_format($item->total_price,2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="border-top: 2px dashed #000; margin: 15px 0;"></div>

        <!-- Totals -->
        <table style="width: 100%; margin-bottom: 15px; font-family: 'Courier New', monospace;">
            <tr>
                <td style="padding: 5px 0; width: 70%;">Subtotal:</td>
                <td style="text-align: right; padding: 5px 0; font-weight: bold;">{{ number_format($order->subtotal, 2) }}</td>
            </tr>
            <tr>
                <td style="padding: 5px 0;">VAT (5%):</td>
                <td style="text-align: right; padding: 5px 0;">{{ number_format($order->subtotal * 0.05, 2) }}</td>
            </tr>
            <tr style="border-top: 2px solid #000;">
                <td style="padding: 10px 0; font-weight: bold;">TOTAL:</td>
                <td style="text-align: right; padding: 10px 0; font-weight: bold; font-size: 16px;">{{ number_format($order->subtotal + ($order->subtotal * 0.05), 2) }}</td>
            </tr>
        </table>

        @if($order->status !== 'delivered')
            <form method="POST" action="{{ route('orders.status', $order->id) }}" style="text-align:center; margin-bottom: 10px;">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="delivered">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-truck me-1"></i> Mark as Delivered
                </button>
            </form>
        @else
            <div style="text-align:center; color:#28a745; font-weight:600; margin-bottom: 10px;">
                <i class="fas fa-check-circle"></i> Delivered
            </div>
        @endif

        <!-- Footer -->
        <div style="text-align: center;">
            <div style="font-weight: bold; margin-bottom: 10px;">THANK YOU FOR YOUR PURCHASE!</div>
        </div>
    </div>
</div>

<!-- Buttons -->
<div class="text-center mt-3">
    <button onclick="printInvoice()" class="btn" style="background-color:coral;color:white">🖨 Print Invoice</button>
    <a href="{{ route('orders.index') }}" class="btn" style="background-color:coral;color:white">← Back to Orders</a>
</div>

<script>
function printInvoice() {
    var printContents = document.getElementById('invoiceContent').innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    location.reload(); // restore JS & styles
}
</script>
@endsection
