@extends('layout.erp.app')

@section('title', 'Edit ' . $supplier->name . ' | Supplier Management')

@section('content')

<style>
    :root {
        --coral: #FF6B6B;
        --coral-light: #FF8E8E;
        --coral-bg: #FFF5F5;
        --coral-border: #FFE5E5;
        --coral-shadow: rgba(255, 107, 107, 0.1);
    }

    .edit-page {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 100vh;
        padding: 30px 0;
    }

    .edit-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 15px;
    }

    /* Header Card */
    .header-card {
        background: linear-gradient(135deg, var(--coral) 0%, var(--coral-light) 100%);
        color: white;
        border-radius: 20px;
        padding: 1.5rem 2rem;
        box-shadow: 0 10px 30px rgba(255, 107, 107, 0.25);
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .header-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
        background-size: 25px 25px;
        opacity: 0.3;
    }

    /* Form Card */
    .form-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid var(--coral-border);
        animation: slideUp 0.5s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Form Groups */
    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }

    .form-label {
        color: #333;
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-label i {
        color: var(--coral);
        width: 20px;
    }

    .form-control {
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #fff;
    }

    .form-control:focus {
        border-color: var(--coral);
        box-shadow: 0 0 0 0.25rem rgba(255, 107, 107, 0.1);
        background: #fff;
    }

    .form-control.is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* Status Switch */
    .status-switch {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 30px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 30px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 22px;
        width: 22px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .slider {
        background-color: var(--coral);
    }

    input:checked + .slider:before {
        transform: translateX(30px);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid var(--coral-border);
    }

    .btn-save {
        background: linear-gradient(135deg, var(--coral) 0%, var(--coral-light) 100%);
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        flex: 1;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(255, 107, 107, 0.2);
    }

    .btn-cancel {
        background: #fff;
        color: #666;
        border: 2px solid #e0e0e0;
        padding: 0.75rem 2rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        flex: 1;
    }

    .btn-cancel:hover {
        border-color: var(--coral);
        color: var(--coral);
        transform: translateY(-2px);
    }

    /* Back Button */
    .back-btn {
        color: var(--coral);
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 8px;
        transition: all 0.3s ease;
        margin-bottom: 1.5rem;
        background: white;
        border: 1px solid var(--coral-border);
    }

    .back-btn:hover {
        background: var(--coral-bg);
        transform: translateX(-5px);
        color: var(--coral-light);
    }

    /* Info Box */
    .info-box {
        background: var(--coral-bg);
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border-left: 4px solid var(--coral);
    }

    .info-box h6 {
        color: var(--coral);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form-card {
            padding: 1.5rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-save, .btn-cancel {
            width: 100%;
        }
    }
</style>

<div class="edit-page">
    <div class="edit-container">
        <!-- Back Button -->
        <a href="{{ route('suppliers.show', $supplier->id) }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Supplier
        </a>

        <!-- Header -->
        <div class="header-card">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h3 class="mb-1">
                        <i class="fas fa-edit me-2"></i>Edit Supplier
                    </h3>
                    <p class="mb-0 opacity-75">Update details for {{ $supplier->name }}</p>
                </div>
                <div class="text-end">
                    <span class="badge bg-light text-dark px-3 py-2">
                        <i class="fas fa-hashtag me-1"></i>ID: {{ str_pad($supplier->id, 4, '0', STR_PAD_LEFT) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Current Info Box -->
        <div class="info-box">
            <div class="row">
                <div class="col-md-6">
                    <h6><i class="fas fa-info-circle me-2"></i>Current Information</h6>
                    <p class="mb-1"><strong>Name:</strong> {{ $supplier->name }}</p>
                    <p class="mb-1"><strong>Phone:</strong> {{ $supplier->phone }}</p>
                    <p class="mb-0"><strong>Type:</strong> {{ ucfirst($supplier->supplier_type) }}</p>
                </div>
                <div class="col-md-6">
                    <h6><i class="fas fa-clock me-2"></i>Timestamps</h6>
                    <p class="mb-1"><strong>Created:</strong> {{ $supplier->created_at->format('d M Y, h:i A') }}</p>
                    <p class="mb-1"><strong>Last Updated:</strong> {{ $supplier->updated_at->format('d M Y, h:i A') }}</p>
                    <p class="mb-0"><strong>Status:</strong> {{ $supplier->is_active ? 'Active' : 'Inactive' }}</p>
                </div>
            </div>
        </div>

        <!-- Edit Form -->
        <div class="form-card">
            <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST" id="editSupplierForm">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Basic Information -->
                    <div class="col-md-6">
                        <h5 class="text-coral mb-3">
                            <i class="fas fa-user-circle me-2"></i>Basic Information
                        </h5>

                        <!-- Supplier Name -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-user"></i>Supplier Name *
                            </label>
                            <input type="text"
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $supplier->name) }}"
                                   placeholder="Enter supplier name"
                                   required>
                            @error('name')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Company Name -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-building"></i>Company Name
                            </label>
                            <input type="text"
                                   name="company_name"
                                   class="form-control @error('company_name') is-invalid @enderror"
                                   value="{{ old('company_name', $supplier->company_name) }}"
                                   placeholder="Enter company name">
                            @error('company_name')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Supplier Type -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-tag"></i>Supplier Type *
                            </label>
                            <select name="supplier_type"
                                    class="form-control @error('supplier_type') is-invalid @enderror"
                                    required>
                                <option value="food" {{ old('supplier_type', $supplier->supplier_type) == 'food' ? 'selected' : '' }}>Food</option>
                                <option value="beverage" {{ old('supplier_type', $supplier->supplier_type) == 'beverage' ? 'selected' : '' }}>Beverage</option>
                                <option value="equipment" {{ old('supplier_type', $supplier->supplier_type) == 'equipment' ? 'selected' : '' }}>Equipment</option>
                                <option value="other" {{ old('supplier_type', $supplier->supplier_type) == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('supplier_type')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="col-md-6">
                        <h5 class="text-coral mb-3">
                            <i class="fas fa-address-book me-2"></i>Contact Information
                        </h5>

                        <!-- Phone Number -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-phone"></i>Phone Number *
                            </label>
                            <input type="text"
                                   name="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   value="{{ old('phone', $supplier->phone) }}"
                                   placeholder="Enter phone number"
                                   required>
                            @error('phone')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-envelope"></i>Email Address
                            </label>
                            <input type="email"
                                   name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', $supplier->email) }}"
                                   placeholder="Enter email address">
                            @error('email')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-map-marker-alt"></i>Address
                            </label>
                            <textarea name="address"
                                      class="form-control @error('address') is-invalid @enderror"
                                      rows="3"
                                      placeholder="Enter full address">{{ old('address', $supplier->address) }}</textarea>
                            @error('address')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <!-- Financial Information -->
                    <div class="col-md-6">
                        <h5 class="text-coral mb-3">
                            <i class="fas fa-money-bill-wave me-2"></i>Financial Information
                        </h5>

                        <!-- Balance -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-balance-scale"></i>Current Balance
                            </label>
                            <input type="number"
                                   name="balance"
                                   class="form-control @error('balance') is-invalid @enderror"
                                   value="{{ old('balance', $supplier->balance) }}"
                                   step="0.01"
                                   placeholder="0.00">
                            <small class="form-text text-muted">Positive for credit, negative for debit</small>
                            @error('balance')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Additional Settings -->
                    <div class="col-md-6">
                        <h5 class="text-coral mb-3">
                            <i class="fas fa-cogs me-2"></i>Additional Settings
                        </h5>

                        <!-- Payment Terms -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-file-invoice-dollar"></i>Payment Terms
                            </label>
                            <input type="text"
                                   name="payment_terms"
                                   class="form-control @error('payment_terms') is-invalid @enderror"
                                   value="{{ old('payment_terms', $supplier->payment_terms) }}"
                                   placeholder="e.g., Cash, 30 Days Credit">
                            @error('payment_terms')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-power-off"></i>Supplier Status
                            </label>
                            <div class="status-switch">
                                <label class="switch">
                                    <input type="checkbox"
                                           name="is_active"
                                           value="1"
                                           {{ old('is_active', $supplier->is_active) ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                                <span class="fw-medium">
                                    {{ $supplier->is_active ? 'Active Supplier' : 'Inactive Supplier' }}
                                </span>
                            </div>
                            <small class="form-text text-muted">Toggle to activate/deactivate supplier</small>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button type="submit" class="btn-save">
                        <i class="fas fa-save me-2"></i>Save Changes
                    </button>
                    <a href="{{ route('suppliers.show', $supplier->id) }}" class="btn-cancel">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Form validation and enhancement
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('editSupplierForm');

        // Phone number formatting
        const phoneInput = form.querySelector('input[name="phone"]');
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                if (value.length <= 3) {
                    value = value;
                } else if (value.length <= 6) {
                    value = value.slice(0, 3) + '-' + value.slice(3);
                } else if (value.length <= 10) {
                    value = value.slice(0, 3) + '-' + value.slice(3, 6) + '-' + value.slice(6);
                } else {
                    value = value.slice(0, 3) + '-' + value.slice(3, 6) + '-' + value.slice(6, 10);
                }
            }
            e.target.value = value;
        });

        // Balance formatting
        const balanceInput = form.querySelector('input[name="balance"]');
        balanceInput.addEventListener('blur', function() {
            if (this.value) {
                this.value = parseFloat(this.value).toFixed(2);
            }
        });

        // Status switch label update
        const statusSwitch = form.querySelector('input[name="is_active"]');
        const statusLabel = form.querySelector('.status-switch span.fw-medium');

        statusSwitch.addEventListener('change', function() {
            statusLabel.textContent = this.checked ? 'Active Supplier' : 'Inactive Supplier';
        });

        // Form submission confirmation
        form.addEventListener('submit', function(e) {
            const name = form.querySelector('input[name="name"]').value;
            const phone = form.querySelector('input[name="phone"]').value;

            if (!name.trim() || !phone.trim()) {
                e.preventDefault();
                showToast('Please fill in all required fields', 'warning');
                return;
            }

            // Optional: Add loading animation
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Saving...';
            submitBtn.disabled = true;
        });

        // Toast notification function
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `alert alert-${type} position-fixed top-0 end-0 m-3`;
            toast.style.zIndex = '9999';
            toast.innerHTML = `
                <div class="d-flex align-items-center">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
                    <span>${message}</span>
                </div>
            `;
            document.body.appendChild(toast);

            setTimeout(() => toast.remove(), 3000);
        }

        // Auto-suggest for supplier type
        const supplierTypeSelect = form.querySelector('select[name="supplier_type"]');
        const customTypeInput = document.createElement('input');
        customTypeInput.type = 'text';
        customTypeInput.className = 'form-control mt-2 d-none';
        customTypeInput.placeholder = 'Enter custom supplier type';
        customTypeInput.name = 'custom_supplier_type';

        supplierTypeSelect.parentNode.appendChild(customTypeInput);

        supplierTypeSelect.addEventListener('change', function() {
            if (this.value === 'other') {
                customTypeInput.classList.remove('d-none');
                customTypeInput.required = true;
            } else {
                customTypeInput.classList.add('d-none');
                customTypeInput.required = false;
            }
        });
    });
</script>
@endsection
