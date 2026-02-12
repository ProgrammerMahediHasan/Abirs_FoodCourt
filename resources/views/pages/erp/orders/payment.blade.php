@extends('layout.erp.app')

@section('content')
<div class="container py-4">
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">Make Payment</h4>
                        <span class="badge bg-dark">#{{ $order->order_no }}</span>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('orders.payment.process', $order->id) }}" id="paymentForm">
                        @csrf

                        <input type="hidden" name="payment_method" id="payment_method" value="cash">

                        <div class="row g-3 mb-3">
                            <div class="col-md-3">
                                <div class="border rounded p-3 text-center method-card active" data-method="cash" style="cursor:pointer">
                                    <div class="display-6 mb-2"><i class="fas fa-coins"></i></div>
                                    <div class="fw-bold">Cash</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="border rounded p-3 text-center method-card" data-method="bank" style="cursor:pointer">
                                    <div class="display-6 mb-2"><i class="fas fa-university"></i></div>
                                    <div class="fw-bold">Bank</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="border rounded p-3 text-center method-card" data-method="cod" style="cursor:pointer">
                                    <div class="display-6 mb-2"><i class="fas fa-truck"></i></div>
                                    <div class="fw-bold">COD</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="border rounded p-3 text-center method-card" data-method="online" style="cursor:pointer">
                                    <div class="display-6 mb-2"><i class="fas fa-wifi"></i></div>
                                    <div class="fw-bold">Online</div>
                                </div>
                            </div>
                        </div>

                        <div id="paymentExtraFields" class="mb-3" style="display:none;">
                            <div class="mb-2" data-method="bank" style="display:none;">
                                <label class="form-label">Bank Name</label>
                                <input type="text" class="form-control" placeholder="e.g., Brac Bank">
                                <label class="form-label mt-2">Account / Reference</label>
                                <input type="text" class="form-control" placeholder="Account No / Reference">
                            </div>
                            <div class="mb-2" data-method="online" style="display:none;">
                                <label class="form-label">Gateway</label>
                                <input type="text" class="form-control" placeholder="e.g., SSLCOMMERZ/Bkash/Nagad">
                                <label class="form-label mt-2">Transaction ID</label>
                                <input type="text" class="form-control" placeholder="TXN-...">
                            </div>
                            <div class="mb-2" data-method="cod" style="display:none;">
                                <small class="text-muted">Cash on Delivery selected.</small>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check-circle me-1"></i> Make Payment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Order Summary</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Customer</span>
                        <span class="fw-bold">{{ $order->customer->name ?? 'Walk-in' }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Items</span>
                        <span class="fw-bold">{{ $order->items->count() }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span class="fw-bold">৳{{ number_format($order->subtotal,2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between border-top pt-2">
                        <span class="fw-bold">Total</span>
                        <span class="fw-bold">৳{{ number_format($order->total,2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
const methodCards = document.querySelectorAll('.method-card');
const methodInput = document.getElementById('payment_method');
const extra = document.getElementById('paymentExtraFields');
function selectMethod(m) {
  methodCards.forEach(c => c.classList.remove('active'));
  const target = Array.from(methodCards).find(c => c.getAttribute('data-method') === m);
  if (target) target.classList.add('active');
  methodInput.value = m;
  extra.style.display = m === 'cash' ? 'none' : 'block';
  extra.querySelectorAll('[data-method]').forEach(el => {
    el.style.display = (el.getAttribute('data-method') === m) ? '' : 'none';
  });
}
methodCards.forEach(c => c.addEventListener('click', () => selectMethod(c.getAttribute('data-method'))));
selectMethod(methodInput.value || 'cash');
</script>
@endsection
