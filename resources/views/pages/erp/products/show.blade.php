@extends('layout.erp.app')
@section('dashboard')
Welcome to Abir's FoodCourt
@endsection
@section('content')
<div class="container py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-0" style="color:#FF7F50;">
                <i class="fas fa-box"></i> Product Details
            </h3>
            <small class="text-muted">View complete information of the product</small>
        </div>
        <a href="{{ route('products.index') }}" class="btn btn-coral" style="background: #FF7F50; color:#000">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>

    <!-- Product Card -->
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-6">
                    <h5>Product Name</h5>
                    <p><strong style="color:#000;">{{ $product->name }}</strong></p>
                </div>
                <div class="col-md-6">
                    <h5>Product Code</h5>
                    <p><strong style="color:#000;">{{ $product->code }}</strong></p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <h5>Category</h5>
                    <p>{{ $product->category->name ?? '-' }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Supplier</h5>
                    <p>{{ $product->supplier->name ?? '-' }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <h5>Current Stock</h5>
                    <p><strong>{{ $product->current_stock }} {{ $product->unit }}</strong></p>
                </div>
                <div class="col-md-4">
                    <h5>Reorder Level</h5>
                    <p>{{ $product->reorder_level }} {{ $product->unit }}</p>
                </div>
                <div class="col-md-4">
                    <h5>Last Purchase Price</h5>
                    <p>${{ number_format($product->last_purchase_price ?? 0, 2) }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <h5>Status</h5>
                    <p>
                        @if($product->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </p>
                </div>
                <div class="col-md-6">
                    <h5>Description</h5>
                    <p>{{ $product->description ?? '-' }}</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning me-2">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i> Delete
                    </button>
                </form>
            </div>

        </div>
    </div>

</div>
@endsection

@push('styles')
<style>
    .btn-coral {
        background: #FF7F50;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 6px;
    }
    .btn-coral:hover {
        background: #E06B3D;
        color: white;
    }
    h5 {
        font-weight: 600;
        color: #FF7F50;
        margin-bottom: 5px;
    }
    p {
        margin-bottom: 10px;
    }
</style>
@endpush
