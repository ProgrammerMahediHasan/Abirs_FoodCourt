@extends('layout.erp.app')

@section('dashboard')
Products
@endsection
@section('content')
<div class="container-fluid">

    <!-- Header Stats -->
    <div class="row mb-4">
        @php
            $stats = [
                ['title'=>'Total Products','count'=>$totalProducts ?? 0,'bg'=>'bg-coral','icon'=>'fa-box'],
                ['title'=>'Low Stock','count'=>$lowStockCount ?? 0,'bg'=>'bg-warning','icon'=>'fa-exclamation-triangle'],
                ['title'=>'Out of Stock','count'=>$outOfStockCount ?? 0,'bg'=>'bg-danger','icon'=>'fa-times-circle'],
                ['title'=>'Stock Value','count'=>number_format($totalStockValue ?? 0,2),'bg'=>'bg-success','icon'=>'fa-dollar-sign']
            ];
        @endphp

        @foreach($stats as $stat)
            <div class="col-md-3 mb-3">
                <div class="card text-white shadow {{ $stat['bg'] }}">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">{{ $stat['title'] }}</h6>
                            <h3 class="mb-0 mt-2">{{ $stat['count'] }}</h3>
                        </div>
                        <div class="bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="fas {{ $stat['icon'] }} fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Products Card -->
    <div class="card shadow border-0">
        <div class="card-header d-flex justify-content-between align-items-center bg-coral text-white py-3">
            <div>
                <h5 class="mb-0"><i class="fas fa-boxes me-2"></i> Products</h5>
                <small class="opacity-75">Manage your inventory products</small>
            </div>
            <a href="{{ route('products.create') }}" class="btn btn-dark btn-sm mt-2">
                <i class="fas fa-plus me-1"></i> Add Product
            </a>
        </div>

        <div class="card-body">

            <!-- Search & Filters -->
            <form method="GET" action="{{ route('products.index') }}" class="row g-2 mb-4 align-items-center">
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Search products..." value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-2">
                    <select name="category_id" class="form-select">
                        <option value="">All Categories</option>
                        @foreach($categories ?? [] as $category)
                            <option value="{{ $category->id }}" {{ request('category_id')==$category->id?'selected':'' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="supplier_id" class="form-select">
                        <option value="">All Suppliers</option>
                        @foreach($suppliers ?? [] as $supplier)
                            <option value="{{ $supplier->id }}" {{ request('supplier_id')==$supplier->id?'selected':'' }}>{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="is_active" class="form-select">
                        <option value="">All Status</option>
                        <option value="1" {{ request('is_active')=='1'?'selected':'' }}>Active</option>
                        <option value="0" {{ request('is_active')=='0'?'selected':'' }}>Inactive</option>
                    </select>
                </div>

                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-coral"><i class="fas fa-filter me-1"></i> Filter</button>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary"><i class="fas fa-redo"></i></a>
                </div>
            </form>

            <!-- Products Table -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr >
                            <th style="background-color:#FF6B3D">Product</th>
                            <th style="background-color:#FF6B3D">Code</th>
                            <th style="background-color:#FF6B3D">Category</th>
                            <th style="background-color:#FF6B3D">Stock</th>
                            <th style="background-color:#FF6B3D">Pcs</th>
                            <th style="background-color:#FF6B3D">Price</th>
                            <th style="background-color:#FF6B3D">Status</th>
                            <th style="background-color:#FF6B3D">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        @php
                            $stock = $product->current_stock;
                            if($stock <= 0){
                                $stockStatus='Out of Stock'; $badge='danger'; $icon='fa-times-circle';
                            } elseif($stock <= $product->reorder_level){
                                $stockStatus='Low Stock'; $badge='warning'; $icon='fa-exclamation-triangle';
                            } else{
                                $stockStatus='In Stock'; $badge='success'; $icon='fa-check-circle';
                            }
                        @endphp
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-coral text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width:35px;height:35px;">
                                        <i class="fas fa-box"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $product->name }}</h6>
                                        @if($product->description)
                                            <small class="text-muted">{{ Str::limit($product->description,30) }}</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>{{ $product->code ?? '-' }}</td>
                            <td>{{ $product->category->name ?? '-' }}</td>
                            <td>
                                <strong>{{ $stock }}</strong>
                                <div class="text-muted small">
                                    <i class="fas {{ $icon }} text-{{ $badge }} me-1"></i>{{ $stockStatus }}
                                </div>
                            </td>
                            <td>{{ $product->unit ?? 'pcs' }}</td>
                            <td>${{ number_format($product->last_purchase_price ?? 0,2) }}</td>
                            <td><span class="badge bg-{{ $product->is_active ? 'success' : 'secondary' }}">{{ $product->is_active ? 'Active' : 'Inactive' }}</span></td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('products.show',$product->id) }}" class="btn btn-sm btn-outline-info"><i class="fas fa-eye"></i></a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fas fa-box fa-3x mb-2"></i>
                                <div>No products found.</div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-3">
                <small class="text-muted">Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} products</small>
                {{ $products->links() }}
            </div>
            @endif

        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .bg-coral{background:#FF7F50 !important;color:#fff;}
    .btn-coral{background:#FF7F50;color:#fff;border-color:#FF7F50;}
    .btn-coral:hover{background:#FF6B3D;color:#fff;border-color:#FF6B3D;}
    .table th{font-weight:600;border-bottom:2px solid #FF7F50;}
    .table-hover tbody tr:hover{background-color:rgba(255,127,80,0.05);}
    .card-header{border-bottom:1px solid rgba(255,127,80,0.2);}
</style>
@endpush
