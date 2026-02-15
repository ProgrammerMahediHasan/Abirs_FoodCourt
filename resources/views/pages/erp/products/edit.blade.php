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
                <i class="fas fa-edit"></i> Edit Product
            </h3>
            <small class="text-muted">Update product details below</small>
        </div>
        <a href="{{ route('products.index') }}" class="btn btn-coral">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>

    <!-- Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Form Card -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label required">Product Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Product Code</label>
                        <input type="text" name="code" class="form-control" value="{{ old('code', $product->code) }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-select">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Supplier</label>
                        <select name="supplier_id" class="form-select">
                            <option value="">Select Supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label required">Current Stock</label>
                        <input type="number" name="current_stock" class="form-control" value="{{ old('current_stock', $product->current_stock) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label required">Reorder Level</label>
                        <input type="number" name="reorder_level" class="form-control" value="{{ old('reorder_level', $product->reorder_level) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label required">Last Purchase Price ($)</label>
                        <input type="number" name="last_purchase_price" step="0.01" class="form-control" value="{{ old('last_purchase_price', $product->last_purchase_price) }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label required">Status</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_active" value="1" {{ old('is_active', $product->is_active) == 1 ? 'checked' : '' }}>
                        <label class="form-check-label">Active</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="is_active" value="0" {{ old('is_active', $product->is_active) == 0 ? 'checked' : '' }}>
                        <label class="form-check-label">Inactive</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-coral"><i class="fas fa-save me-1"></i> Update Product</button>
                </div>

            </form>
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
    .form-label.required::after {
        content: "*";
        color: red;
        margin-left: 2px;
    }
</style>
@endpush
