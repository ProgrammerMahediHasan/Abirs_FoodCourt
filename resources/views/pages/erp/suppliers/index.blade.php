@extends('layout.erp.app')
@section('dashboard')
Welcome to Abir's FoodCourt
@endsection
@section('content')

<style>
    body {
        background: #f5f5f5;
    }

    .coral-color { color: #FF7F50; }
    .coral-bg { background: #FF7F50; color: white; }

    .header-section {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }

    .table-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .table th {
        background-color: #FF7F50 !important; /* coral background */
        color: #000 !important; /* black text */
        font-weight: 600;
    }

    .status-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 5px;
    }

    .active-dot { background: #28a745; }
    .inactive-dot { background: #dc3545; }

    .action-btn {
        width: 35px;
        height: 35px;
        border-radius: 5px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: .2s;
    }

    .action-btn:hover { transform: translateY(-2px); }

    .stats-card {
        text-align: center;
        padding: 15px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .empty-state {
        text-align: center;
        padding: 40px;
        color: #777;
    }

    /* Product list styling inside table cell */
    .product-list {
        font-size: 0.9rem;
    }
    .product-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 2px;
    }
</style>

<div class="container-fluid">

    <!-- Header -->
    <div class="header-section d-flex justify-content-between align-items-center">
        <div>
            <h3 class="coral-color mb-0">
                <i class="fas fa-truck me-2"></i>Suppliers
            </h3>
            <small class="text-muted">Manage your suppliers</small>
        </div>
        <a href="{{ route('suppliers.create') }}" class="btn coral-bg">
            <i class="fas fa-plus me-1"></i> Add Supplier
        </a>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Search & Filter -->
    <div class="row mb-3">
        <div class="col-md-8">
            <input type="text" id="searchInput" class="form-control"
                   placeholder="Search by name, phone, email..."
                   oninput="searchSuppliers()">
        </div>
        <div class="col-md-4">
            <select id="statusFilter" class="form-select" onchange="searchSuppliers()">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
    </div>

    <!-- Table -->
    <div class="table-card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody id="suppliersTable">
                @foreach($suppliers as $supplier)
                    <tr class="supplier-row"
                        data-name="{{ strtolower($supplier->name) }}"
                        data-phone="{{ $supplier->phone }}"
                        data-email="{{ strtolower($supplier->email ?? '') }}"
                        data-status="{{ $supplier->is_active ? 'active' : 'inactive' }}">

                        <!-- Supplier Name -->
                        <td>
                            <strong style="color: #000;">{{ $supplier->name }}</strong><br>
                            @if($supplier->company_name)
                                <small class="text-muted">{{ $supplier->company_name }}</small>
                            @endif
                        </td>

                        <!-- Contact Info -->
                        <td>
                            <i class="fas fa-phone me-1"></i>
                            <strong style="color: #000;">{{ $supplier->phone }}</strong><br>
                            @if($supplier->email)
                                <small>{{ $supplier->email }}</small>
                            @endif
                        </td>

                        <!-- Supplier Type -->
                        <td>
                            <span class="badge bg-light text-dark">
                                {{ ucfirst($supplier->supplier_type) }}
                            </span>
                        </td>



                        <!-- Status -->
                        <td>
                            @if($supplier->is_active)
                                <span class="text-success">
                                    <span class="status-dot active-dot"></span>Active
                                </span>
                            @else
                                <span class="text-danger">
                                    <span class="status-dot inactive-dot"></span>Inactive
                                </span>
                            @endif
                        </td>

                        <!-- Actions -->
                        <td class="text-end">
                            <div class="d-inline-flex gap-2">
                                <a href="{{ route('suppliers.show',$supplier->id) }}"
                                   class="action-btn bg-info text-white">
                                    <i class="fas fa-eye"></i>
                                </a>
                                {{-- <a href="{{ route('suppliers.edit',$supplier->id) }}"
                                   class="action-btn bg-warning text-white">
                                    <i class="fas fa-edit"></i>
                                </a> --}}
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        @if($suppliers->count() == 0)
            <div class="empty-state">
                <h5>No suppliers found</h5>
            </div>
        @endif

        <!-- Pagination -->
        <div class="p-3">
            {{ $suppliers->links() }}
        </div>
    </div>
</div>

<script>
function searchSuppliers() {
    const search = document.getElementById('searchInput').value.toLowerCase();
    const status = document.getElementById('statusFilter').value;
    const rows = document.querySelectorAll('.supplier-row');

    rows.forEach(row => {
        const matchSearch =
            row.dataset.name.includes(search) ||
            row.dataset.phone.includes(search) ||
            row.dataset.email.includes(search);

        const matchStatus =
            status === '' || row.dataset.status === status;

        row.style.display = (matchSearch && matchStatus) ? '' : 'none';
    });
}
</script>

@endsection
