@extends('layout.erp.app')

@section('dashboard')
Welcome to Abir's FoodCourt
@endsection

@section('content')

<style>
    :root{
        --coral: #FF7F50;
        --coral-dark: #ff6b3d;
        --coral-light: #fff1ec;
    }

    .menu-wrapper{
        max-width: 1400px; /* 🔥 wider professional width */
        margin: auto;
    }

    .menu-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 12px 35px rgba(0,0,0,.08);
        overflow: hidden;
    }

    .menu-card-header {
        background: linear-gradient(135deg, var(--coral), var(--coral-dark));
        color: #fff;
        padding: 20px 30px;
    }

    .menu-card-header h4 {
        margin: 0;
        font-weight: 600;
        letter-spacing: .3px;
    }

    .menu-card-body {
        padding: 32px;
        background: #fff;
    }

    .form-label {
        font-weight: 600;
        color: #444;
        margin-bottom: 6px;
    }

    .form-control, .form-select {
        border-radius: 10px;
        padding: 12px 14px;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--coral);
        box-shadow: 0 0 0 .2rem rgba(255,127,80,.2);
    }

    .btn-coral {
        background: var(--coral);
        color: #fff;
        border-radius: 10px;
        padding: 12px 26px;
        font-weight: 600;
    }

    .btn-coral:hover {
        background: var(--coral-dark);
        color: #fff;
    }

    .btn-outline-coral {
        border: 1px solid var(--coral);
        color: var(--coral);
        border-radius: 10px;
        padding: 12px 26px;
        font-weight: 600;
    }

    .btn-outline-coral:hover {
        background: var(--coral);
        color: #fff;
    }

    .error-box {
        border-left: 5px solid var(--coral);
    }
</style>

<div class="container-fluid px-4">
    <div class="menu-wrapper">

        <!-- Error Message -->
        @if ($errors->any())
            <div class="alert alert-danger error-box mb-4">
                <strong>Oops!</strong> Please fix the following errors:
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Card -->
        <div class="menu-card">
            <div class="menu-card-header d-flex align-items-center">
                <i class="fas fa-utensils me-2 fs-5"></i>
                <h4>Add New Menu Item</h4>
            </div>

            <div class="menu-card-body">
                <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-4">

                        <!-- Category -->
                        <div class="col-lg-4">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="col-lg-4">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <!-- Price -->
                        <div class="col-lg-4">
                            <label class="form-label">Price (৳)</label>
                            <input type="number" name="price" class="form-control"
                                   step="0.01" placeholder="Enter price" required>
                        </div>

                        <!-- Menu Name -->
                        <div class="col-lg-6">
                            <label class="form-label">Menu Name</label>
                            <input type="text" name="name" class="form-control"
                                   placeholder="e.g. Classic Beef Burger" required>
                        </div>

                        <!-- Image -->
                        <div class="col-lg-6">
                            <label class="form-label">Menu Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <!-- Description -->
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="3"
                                      class="form-control"
                                      placeholder="Short description about the menu item"></textarea>
                        </div>

                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-end gap-3 mt-5">
                        <a href="{{ route('menus.index') }}" class="btn btn-outline-coral">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                        <button type="submit" class="btn btn-coral">
                            <i class="fas fa-save me-1"></i> Save Menu
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

@endsection
