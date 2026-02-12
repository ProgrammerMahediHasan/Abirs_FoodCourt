@extends('layout.erp.app')
@section('content')

<div class="dashboard-container d-flex flex-column align-items-center">

    <!-- Page Header -->
    <div class="dashboard-header mb-5" style="max-width: 1200px; width: 100%;">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h1 class="page-title mb-2">Analysis Form</h1>
                <p class="page-subtitle text-muted">
                    <i class="fas fa-calendar-alt me-2"></i>{{ now()->format('l, F d, Y') }}
                    <span class="mx-3">•</span>
                    <i class="fas fa-clock me-2"></i>{{ now()->format('h:i A') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card p-4 mb-5" style="max-width: 800px; width: 100%; border-radius: 16px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
        <h4 class="mb-4">Enter Analysis Details</h4>

        <form action="{{ route('analysis.store') }}" method="POST">
            @csrf

            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label for="analyst_name" class="form-label">Analyst Name</label>
                    <input type="text" class="form-control" id="analyst_name" name="analyst_name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ now()->format('Y-m-d') }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="sales">Sales</option>
                    <option value="inventory">Inventory</option>
                    <option value="revenue">Revenue</option>
                    <option value="customer">Customer</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description / Notes</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Add any notes or details here"></textarea>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label for="value" class="form-label">Value</label>
                    <input type="number" class="form-control" id="value" name="value" placeholder="Numeric Value" step="0.01" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="unit" class="form-label">Unit</label>
                    <input type="text" class="form-control" id="unit" name="unit" placeholder="Unit (e.g., Kg, Pcs, $)">
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-paper-plane me-2"></i> Submit Analysis
            </button>
        </form>
    </div>

    <!-- Optional Stats Cards Below Form -->
    <div class="row mb-5 justify-content-center" style="max-width: 1200px; width: 100%;">
        <div class="col-md-4 mb-4">
            <div class="stat-card stat-primary">
                <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                <div class="stat-content">
                    <h3 class="stat-value">125</h3>
                    <p class="stat-label">Sales Entries</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="stat-card stat-success">
                <div class="stat-icon"><i class="fas fa-boxes"></i></div>
                <div class="stat-content">
                    <h3 class="stat-value">89</h3>
                    <p class="stat-label">Inventory Items</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="stat-card stat-info">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-content">
                    <h3 class="stat-value">42</h3>
                    <p class="stat-label">Customer Entries</p>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
/* Center dashboard container */
.dashboard-container {
    padding: 30px;
    margin-left: 250px;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
}

/* Card Styles */
.card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    border: 1px solid #e2e8f0;
}

/* Stat Cards */
.stat-card {
    background: white;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    display: flex;
    align-items: center;
    gap: 15px;
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: white;
}

.stat-primary .stat-icon { background: linear-gradient(135deg, #4f46e5 0%, #7c73e6 100%); }
.stat-success .stat-icon { background: linear-gradient(135deg, #10b981 0%, #34d399 100%); }
.stat-info .stat-icon { background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 100%); }

.stat-value {
    font-size: 24px;
    font-weight: 700;
}

.stat-label {
    font-size: 14px;
    color: #64748b;
}

/* Responsive */
@media (max-width: 992px) {
    .dashboard-container { margin-left: 0; padding: 20px; }
}
</style>

@endsection
