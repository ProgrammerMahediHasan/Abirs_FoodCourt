@extends('layout.erp.app')

@section('dashboard')
Purchase Item
@endsection

@section('content')
<div class="container py-4">

    <!-- Header -->
    <div class="card header-card mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-1 text-coral">
                    <i class="fas fa-file-invoice"></i> Create Purchase Order
                </h3>
                <p class="text-muted mb-0">Add new items to inventory</p>
            </div>
            <a href="{{ route('purchases.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <!-- Error -->
    @if(session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle me-1"></i> {{ session('error') }}
        </div>
    @endif

    <form id="purchaseForm" action="{{ route('purchases.store') }}" method="POST">
        @csrf

        <!-- Basic Info -->
        <div class="card mb-4">
            <div class="card-header coral-header">
                <i class="fas fa-info-circle me-1"></i> Basic Information
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label required">Supplier</label>
                        <select name="supplier_id" id="supplierSelect" class="form-select" required>
                            <option value="">Select Supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">PO Number</label>
                        <input type="text" class="form-control" value="{{ $po_number }}" readonly>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label required">Order Date</label>
                        <input type="date" name="order_date" class="form-control"
                               value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- Purchase Items -->
        <div class="card mb-4">
            <div class="card-header coral-header">
                <i class="fas fa-shopping-cart me-1"></i> Purchase Items
            </div>
            <div class="card-body">
                <div id="itemsContainer">

                    <!-- Item Row -->
                    <div class="item-row" id="itemRow0">
                        <div class="row g-2">
                            <div class="col-md-5">
                                <label class="form-label required">Product</label>
                                <select name="items[0][product_id]" class="form-select product-select" required>
                                    <option value="">Select Product</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}"
                                            data-price="{{ $product->last_purchase_price }}">
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label class="form-label required">Qty</label>
                                <input type="number" name="items[0][quantity]"
                                       class="form-control quantity" value="1" min="1" required>
                            </div>

                            <div class="col-md-2">
                                <label class="form-label required">Unit Price (৳)</label>
                                <input type="number" name="items[0][unit_price]"
                                       class="form-control unit-price" step="0.01" value="0" required>
                            </div>

                            <div class="col-md-2">
                                <label class="form-label">Total (৳)</label>
                                <input type="text" class="form-control total" readonly value="0.00">
                            </div>

                            <div class="col-md-1 d-flex align-items-end">
                                <button type="button" class="btn btn-danger remove-item-btn" style="display:none">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                <button type="button" class="btn btn-success mt-3" id="addItemBtn">
                    <i class="fas fa-plus"></i> Add Item
                </button>
            </div>
        </div>

        <!-- Summary -->
        <div class="card mb-4">
            <div class="card-header coral-header">
                <i class="fas fa-calculator me-1"></i> Order Summary
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="col-md-4">
                        <div class="summary-box">
                            <table class="table table-sm mb-0">
                                <tr>
                                    <td>Subtotal</td>
                                    <td class="text-end">৳ <span id="subtotal">0.00</span></td>
                                </tr>
                                <tr class="fw-bold">
                                    <td>Grand Total</td>
                                    <td class="text-end text-success">
                                        ৳ <span id="grandTotal">0.00</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit -->
        <div class="text-end">
            <button type="submit" class="btn btn-coral btn-lg">
                <i class="fas fa-save"></i> Save Purchase Order
            </button>
        </div>
    </form>
</div>

{{-- Styles --}}
<style>
:root{
    --coral:#FF7F50;
    --coral-soft:#FFF2ED;
}

.text-coral{color:var(--coral);}
.header-card{
    background:var(--coral-soft);
    border-left:5px solid var(--coral);
    padding:20px;
    border-radius:8px;
}

.coral-header{
    background:var(--coral);
    color:#fff;
    font-weight:600;
}

.item-row{
    background:#fff;
    padding:15px;
    border-radius:8px;
    border-left:4px solid var(--coral);
    margin-bottom:12px;
}

.summary-box{
    background:#f8f9fa;
    padding:15px;
    border-left:4px solid var(--coral);
    border-radius:8px;
}

.btn-coral{
    background:var(--coral);
    color:#fff;
    border:none;
}
.btn-coral:hover{
    background:#E66A3C;
    color:#fff;
}

.form-label.required::after{
    content:" *";
    color:#dc3545;
}
</style>
@endsection
