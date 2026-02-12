@extends('layout.erp.app')

@section('dashboard')
Stocks Inventory
@endsection

@section('content')
<div class="container py-4">

    <!-- Header -->
    <div class="card header-card mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-1 text-coral">
                    <i class="fas fa-warehouse"></i> Add Stock
                </h3>
                <p class="text-muted mb-0">Add or update menu item stock</p>
            </div>
            {{-- <a href="{{ route('stocks.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a> --}}
        </div>
    </div>

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Card -->
    <div class="card shadow-sm border-0">
        <div class="card-header coral-header">
            <i class="fas fa-plus-circle me-1"></i> Stock Details
        </div>
        <div class="card-body">
            <form action="{{ route('stocks.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <!-- Menu -->
                    <div class="col-md-4">
                        <label class="form-label required">Menu Item</label>
                        <select name="menu_id" class="form-select" required>
                            <option value="">Select Menu</option>
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Quantity -->
                    <div class="col-md-3">
                        <label class="form-label required">Available Quantity</label>
                        <input type="number"
                               name="current_quantity"
                               class="form-control"
                               value="{{ old('current_quantity',0) }}"
                               min="0"
                               required>
                    </div>

                    <!-- Unit -->
                    <div class="col-md-3">
                        <label class="form-label">Unit</label>
                        <input type="text"
                               name="unit"
                               class="form-control"
                               value="{{ old('unit','pcs') }}"
                               placeholder="pcs / kg / ltr">
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('stocks.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-back"></i> Back
                    </a>
                    <button type="submit" class="btn btn-coral">
                        <i class="fas fa-save"></i> Save Stock
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Styles --}}
<style>

/* Make all inputs & selects same size */
.form-control,
.form-select {
    height: 46px;              /* SAME HEIGHT */
    padding: 10px 14px;        /* SAME INNER SPACE */
    font-size: 15px;           /* SAME TEXT SIZE */
    border-radius: 8px;
}

/* Label consistency */
.form-label {
    font-weight: 600;
    margin-bottom: 6px;
}

/* Focus effect (professional coral) */
.form-control:focus,
.form-select:focus {
    border-color: #FF7F50;
    box-shadow: 0 0 0 0.2rem rgba(255,127,80,.25);
}



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
