@extends('layout.erp.app')

@section('dashboard')
Supplier Details
@endsection

@section('content')

<style>
    :root{
        --coral: #FF7F50;
        --coral-dark: #ff6b3d;
        --coral-light: #fff1ec;
    }

    .supplier-wrapper{
        max-width: 1300px;
        margin: auto;
    }

    .supplier-card{
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 12px 35px rgba(0,0,0,.08);
        overflow: hidden;
    }

    .supplier-card-header{
        background: linear-gradient(135deg, var(--coral), var(--coral-dark));
        color: #fff;
        padding: 22px 30px;
    }

    .supplier-card-header h4{
        margin: 0;
        font-weight: 600;
    }

    .supplier-card-body{
        padding: 34px;
    }

    .section-title{
        font-weight: 600;
        color: var(--coral);
        margin-bottom: 18px;
        border-bottom: 1px dashed #eee;
        padding-bottom: 6px;
    }

    .form-label{
        font-weight: 600;
        color: #444;
        margin-bottom: 6px;
    }

    .help-text{
        font-size: .85rem;
        color: #888;
        margin-top: 4px;
    }

    .form-control, .form-select{
        border-radius: 10px;
        padding: 12px 14px;
    }

    .form-control:focus, .form-select:focus{
        border-color: var(--coral);
        box-shadow: 0 0 0 .2rem rgba(255,127,80,.2);
    }

    .btn-coral{
        background: var(--coral);
        color: #fff;
        border-radius: 10px;
        padding: 12px 28px;
        font-weight: 600;
    }

    .btn-coral:hover{
        background: var(--coral-dark);
        color: #fff;
    }

    .btn-outline-coral{
        border: 1px solid var(--coral);
        color: var(--coral);
        border-radius: 10px;
        padding: 12px 28px;
        font-weight: 600;
    }

    .btn-outline-coral:hover{
        background: var(--coral);
        color: #fff;
    }
</style>

<div class="container-fluid px-4">
    <div class="supplier-wrapper">

        <!-- Success / Error -->
        @if(session('success'))
            <div class="alert alert-success mb-4">
                <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger mb-4">
                <i class="fas fa-exclamation-circle me-1"></i> {{ session('error') }}
            </div>
        @endif

        <!-- Card -->
        <div class="supplier-card">

            <!-- Header -->
            <div class="supplier-card-header d-flex align-items-center">
                <i class="fas fa-truck me-2 fs-5"></i>
                <h4>Add New Supplier</h4>
            </div>

            <!-- Body -->
            <div class="supplier-card-body">
                <form action="{{ route('suppliers.store') }}" method="POST">
                    @csrf

                    <!-- BASIC INFO -->
                    <h5 class="section-title">
                        <i class="fas fa-user me-2"></i> Basic Information
                    </h5>

                    <div class="row g-4 mb-4">
                        <div class="col-lg-6">
                            <label class="form-label">Supplier Name *</label>
                            <input type="text" name="name" class="form-control"
                                   placeholder="Enter supplier name" required>
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label">Company Name</label>
                            <input type="text" name="company_name" class="form-control"
                                   placeholder="Company / Business name">
                        </div>
                    </div>

                    <!-- CONTACT INFO -->
                    <h5 class="section-title">
                        <i class="fas fa-phone me-2"></i> Contact Information
                    </h5>

                    <div class="row g-4 mb-4">
                        <div class="col-lg-6">
                            <label class="form-label">Phone *</label>
                            <input type="text" name="phone" class="form-control"
                                   placeholder="01XXXXXXXXX" required>
                            <div class="help-text">11-digit Bangladeshi number</div>
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control"
                                   placeholder="email@example.com">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Address</label>
                            <textarea name="address" rows="2"
                                      class="form-control"
                                      placeholder="Full supplier address"></textarea>
                        </div>
                    </div>

                    <!-- BUSINESS INFO -->
                    <h5 class="section-title">
                        <i class="fas fa-briefcase me-2"></i> Business Details
                    </h5>

                    <div class="row g-4 mb-4">
                        <div class="col-lg-6">
                            <label class="form-label">Supplier Type</label>
                            <select name="supplier_type" class="form-select" required>
                                <option value="food">Food Items</option>
                                <option value="meat">Meat & Poultry</option>
                                <option value="vegetable">Vegetables & Fruits</option>
                                <option value="beverage">Beverage</option>
                                <option value="bakery">Bakery</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label">Payment Terms</label>
                            <select name="payment_terms" class="form-select">
                                <option value="cash">Cash</option>
                                <option value="7_days">7 Days Credit</option>
                                <option value="15_days">15 Days Credit</option>
                                <option value="30_days">30 Days Credit</option>
                                <option value="cod">COD</option>
                            </select>
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label">Opening Balance (৳)</label>
                            <input type="number" name="balance" value="0"
                                   class="form-control" step="0.01">
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label">Tax / VAT ID</label>
                            <input type="text" name="tax_id"
                                   class="form-control" placeholder="Optional">
                        </div>
                    </div>

                    <!-- STATUS -->
                    <h5 class="section-title">
                        <i class="fas fa-toggle-on me-2"></i> Status
                    </h5>

                    <div class="mb-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_active" value="1" checked>
                            <label class="form-check-label">Active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="is_active" value="0">
                            <label class="form-check-label">Inactive</label>
                        </div>
                    </div>

                    <!-- NOTES -->
                    <h5 class="section-title">
                        <i class="fas fa-edit me-2"></i> Notes
                    </h5>

                    <div class="mb-4">
                        <textarea name="description" rows="3"
                                  class="form-control"
                                  placeholder="Additional notes or remarks..."></textarea>
                    </div>

                    <!-- ACTIONS -->
                    <div class="d-flex justify-content-end gap-3 pt-4 border-top">
                        <a href="{{ route('suppliers.index') }}" class="btn btn-outline-coral">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                        <button type="submit" class="btn btn-coral">
                            <i class="fas fa-save me-1"></i> Save Supplier
                        </button>
                    </div>

                </form>
            </div>

        </div>

    </div>
</div>

@endsection
