@extends('layout.erp.app')

@section('dashboard')
Products List
@endsection

@section('content')
<div class="container py-4">

    <!-- Header -->
    <div class="card header-card mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-1 text-coral">
                    <i class="fas fa-boxes"></i> Add New Product
                </h3>
                <p class="text-muted mb-0">Fill in product information carefully</p>
            </div>
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Card -->
    <div class="card form-card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <div class="row g-3">

                    <!-- Product Name -->
                    <div class="col-md-6">
                        <label class="form-label required">Product Name</label>
                        <input type="text" name="name" class="form-control"
                               value="{{ old('name') }}" placeholder="Enter product name" required>
                    </div>

                    <!-- Product Code -->
                    <div class="col-md-6">
                        <label class="form-label">Product Code</label>
                        <input type="text" name="code" class="form-control"
                               value="{{ old('code') }}" placeholder="Optional product code">
                    </div>

                    <!-- Category -->
                    <div class="col-md-6">
                        <label class="form-label required">Category</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id')==$category->id?'selected':'' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Supplier -->
                    <div class="col-md-6">
                        <label class="form-label required">Supplier</label>
                        <select name="supplier_id" class="form-select" required>
                            <option value="">Select Supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}"
                                    {{ old('supplier_id')==$supplier->id?'selected':'' }}>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Stock -->
                    <div class="col-md-3">
                        <label class="form-label required">Current Stock</label>
                        <input type="number" step="0.01" name="current_stock"
                               value="{{ old('current_stock',0) }}" class="form-control" required>
                    </div>

                    <!-- Unit -->
                    <div class="col-md-3">
                        <label class="form-label required">Unit</label>
                        <input type="text" name="unit" class="form-control"
                               value="{{ old('unit') }}" placeholder="kg / pcs / ltr" required>
                    </div>

                    <!-- Reorder -->
                    <div class="col-md-3">
                        <label class="form-label">Reorder Level</label>
                        <input type="number" name="reorder_level"
                               value="{{ old('reorder_level',0) }}" class="form-control">
                    </div>

                    <!-- Purchase Price -->
                    <div class="col-md-3">
                        <label class="form-label">Last Purchase Price (৳)</label>
                        <input type="number" step="0.01" name="last_purchase_price"
                               value="{{ old('last_purchase_price',0) }}" class="form-control">
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select name="is_active" class="form-select">
                            <option value="1" {{ old('is_active','1')=='1'?'selected':'' }}>Active</option>
                            <option value="0" {{ old('is_active')=='0'?'selected':'' }}>Inactive</option>
                        </select>
                    </div>

                    <!-- Description -->
                    <div class="col-md-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="3" class="form-control"
                                  placeholder="Optional product notes...">{{ old('description') }}</textarea>
                    </div>

                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-coral">
                        <i class="fas fa-save"></i> Save Product
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

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

.form-card{
    border-radius:10px;
}

.btn-coral{
    background:var(--coral);
    color:#fff;
    border:none;
    padding:10px 22px;
    font-weight:500;
    border-radius:6px;
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
