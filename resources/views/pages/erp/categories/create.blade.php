@extends('layout.erp.app')

@section('dashboard')
Categories List
@endsection

@section('content')

<style>
    :root{
        --coral: #FF7F50;
        --coral-dark: #ff6b3d;
        --coral-light: #fff1ec;
    }

    .category-wrapper{
        max-width: 1200px;
        margin: auto;
    }

    .category-card{
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 12px 35px rgba(0,0,0,.08);
        overflow: hidden;
    }

    .category-card-header{
        background: linear-gradient(135deg, var(--coral), var(--coral-dark));
        color: #fff;
        padding: 20px 30px;
    }

    .category-card-header h4{
        margin: 0;
        font-weight: 600;
        letter-spacing: .3px;
    }

    .category-card-body{
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

    .status-box{
        background: #fafafa;
        border-radius: 12px;
        padding: 16px;
        border: 1px solid #eee;
    }
</style>

<div class="container-fluid px-4">
    <div class="category-wrapper">

        <!-- Card -->
        <div class="category-card">

            <!-- Header -->
            <div class="category-card-header d-flex align-items-center">
                <i class="fas fa-folder-plus me-2 fs-5"></i>
                <h4>Create New Category</h4>
            </div>

            <!-- Body -->
            <div class="category-card-body">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf

                    <div class="row g-4">

                        <!-- Category Name -->
                        <div class="col-lg-6">
                            <label class="form-label">
                                Category Name <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="e.g. Burgers, Drinks"
                                   value="{{ old('name') }}"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-lg-6">
                            <label class="form-label">Status</label>
                            <div class="status-box d-flex gap-4 align-items-center">

                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="radio"
                                           name="status"
                                           id="active"
                                           value="active"
                                           checked>
                                    <label class="form-check-label fw-semibold" for="active">
                                        <span class="badge bg-success px-3 py-2">
                                            <i class="fas fa-check me-1"></i> Active
                                        </span>
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input"
                                           type="radio"
                                           name="status"
                                           id="inactive"
                                           value="inactive">
                                    <label class="form-check-label fw-semibold" for="inactive">
                                        <span class="badge bg-secondary px-3 py-2">
                                            <i class="fas fa-times me-1"></i> Inactive
                                        </span>
                                    </label>
                                </div>

                            </div>
                        </div>

                        <!-- Description -->
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description"
                                      rows="3"
                                      class="form-control @error('description') is-invalid @enderror"
                                      placeholder="Short description (optional)">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-end gap-3 mt-5">
                        <a href="{{ route('categories.index') }}" class="btn btn-outline-coral">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                        <button type="submit" class="btn btn-coral">
                            <i class="fas fa-save me-1"></i> Save Category
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

@endsection
