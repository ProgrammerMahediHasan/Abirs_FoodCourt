@extends('layout.erp.app')

@section('dashboard')
Customer Information
@endsection

@section('content')

<style>
    :root{
        --coral: #FF7F50;
        --coral-dark: #ff6b3d;
        --coral-light: #fff1ec;
    }

    .customer-wrapper{
        max-width: 1200px;
        margin: auto;
    }

    .customer-card{
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 12px 35px rgba(0,0,0,.08);
        overflow: hidden;
    }

    .customer-card-header{
        background: linear-gradient(135deg, var(--coral), var(--coral-dark));
        color: #fff;
        padding: 20px 30px;
    }

    .customer-card-header h4{
        margin: 0;
        font-weight: 600;
        letter-spacing: .3px;
    }

    .customer-card-body{
        padding: 32px;
    }

    .form-label{
        font-weight: 600;
        color: #444;
        margin-bottom: 6px;
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
        padding: 12px 26px;
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
        padding: 12px 26px;
        font-weight: 600;
    }

    .btn-outline-coral:hover{
        background: var(--coral);
        color: #fff;
    }
</style>

<div class="container-fluid px-4">
    <div class="customer-wrapper">

        <!-- Error Message -->
        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <strong>Oops!</strong> Please fix the following errors:
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Card -->
        <div class="customer-card">

            <!-- Header -->
            <div class="customer-card-header d-flex align-items-center">
                <i class="fas fa-user-plus me-2 fs-5"></i>
                <h4>Add New Customer</h4>
            </div>

            <!-- Body -->
            <div class="customer-card-body">
                <form action="{{ route('customer.store') }}" method="POST">
                    @csrf

                    <div class="row g-4">

                        <!-- Name -->
                        <div class="col-lg-6">
                            <label class="form-label">Customer Name <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   placeholder="Enter customer name"
                                   value="{{ old('name') }}"
                                   required>
                        </div>

                        <!-- Email -->
                        <div class="col-lg-6">
                            <label class="form-label">Email</label>
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   placeholder="example@email.com"
                                   value="{{ old('email') }}">
                        </div>

                        <!-- Phone -->
                        <div class="col-lg-6">
                            <label class="form-label">Phone</label>
                            <input type="text"
                                   name="phone"
                                   class="form-control"
                                   placeholder="01XXXXXXXXX"
                                   value="{{ old('phone') }}">
                        </div>

                        <!-- Status -->
                        <div class="col-lg-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <!-- Address -->
                        <div class="col-12">
                            <label class="form-label">Address</label>
                            <textarea name="address"
                                      rows="3"
                                      class="form-control"
                                      placeholder="Customer address">{{ old('address') }}</textarea>
                        </div>

                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-end gap-3 mt-5">
                        <a href="{{ route('customer.index') }}" class="btn btn-outline-coral">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                        <button type="submit" class="btn btn-coral">
                            <i class="fas fa-save me-1"></i> Save Customer
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

@endsection
