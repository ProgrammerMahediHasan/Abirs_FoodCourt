@extends('layout.erp.app')
@section('dashboard')
Order Details
@endsection
@section('content')

<style>
    :root{
        --coral: #FF7F50;
        --coral-dark: #ff6b3d;
        --coral-light: #fff1ec;
    }

    .order-wrapper{
        max-width: 1200px;
        margin: auto;
    }

    .order-card{
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 12px 35px rgba(0,0,0,.08);
        overflow: hidden;
    }

    .order-card-header{
        background: linear-gradient(135deg, var(--coral), var(--coral-dark));
        color: #fff;
        padding: 20px 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .order-card-header h4{
        margin: 0;
        font-weight: 600;
        letter-spacing: .3px;
    }

    .order-card-body{
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
        height: 42px;
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

    .item-row select, .item-row input{
        height: 42px;
        border-radius: 8px;
    }

    .remove-item{
        font-size: 16px;
        font-weight: 600;
        color: var(--coral);
        border: none;
        background: transparent;
    }
</style>

<div class="container-fluid px-4">
    <div class="order-wrapper">

        <!-- Card -->
        <div class="order-card">

            <!-- Header -->
            <div class="order-card-header">
                <h4><i class="fas fa-receipt me-2"></i>Place New Order</h4>
                <small>{{ date('d M Y') }}</small>
            </div>

            <!-- Body -->
            <div class="order-card-body">
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf

                    {{-- Customer & Restaurant Info --}}
                    <div class="row g-4 mb-4">
                        <div class="col-lg-6">
                            <label class="form-label">Customer</label>
                            <select name="customer_id" class="form-select">
                                <option value="">Select Customer</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>

                            <label class="form-label mt-3">Special Note</label>
                            <textarea name="note" class="form-control" rows="2" placeholder="Instructions..."></textarea>
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label required">Restaurant</label>
                            <select name="restaurant_id" class="form-select" required>
                                <option value="">Select Restaurant</option>
                                @foreach($restaurants as $restaurant)
                                    <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                                @endforeach
                            </select>

                            <label class="form-label mt-3 required">Order Type</label>
                            <select name="order_type" class="form-select" required>
                                <option value="">Select Type</option>
                                <option value="dine_in">Dine In</option>
                                <option value="takeaway">Takeaway</option>
                                <option value="delivery">Delivery</option>
                            </select>
                        </div>
                    </div>

                    {{-- Menu Items --}}
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <small>Add menu items</small>
                        <button type="button" id="addItem" class="btn btn-outline-coral btn-sm">
                            + Add Item
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-coral text-white">
                                <tr>
                                    <th style="background-color:#FF7F50;c">Menu Item</th>
                                    <th style="background-color:#FF7F50;c" width="120">Quantity</th>
                                    <th style="background-color:#FF7F50;c" width="50" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="menuItems">
                                <tr class="item-row">
                                    <td>
                                        <select name="menu_ids[]" class="form-select" required>
                                            <option value="">Select Menu</option>
                                            @foreach($menus as $menu)
                                                <option value="{{ $menu->id }}">
                                                    {{ $menu->name }} - ৳{{ $menu->price }}
                                                    @if($menu->stock)
                                                        ({{ $menu->stock->current_quantity }} pcs)
                                                        @if($menu->stock->current_quantity <= 0)
                                                            - Out of Stock
                                                        @endif
                                                    @else
                                                        (Out of Stock)
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="quantities[]" class="form-control" value="1" min="1" required>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="remove-item">✖</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex justify-content-end gap-3 mt-4">
                        <a href="{{ route('orders.index') }}" class="btn btn-outline-coral">
                            <i class="fas fa-arrow-left me-1"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-coral">
                            <i class="fas fa-save me-1"></i> Place Order
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

{{-- JS --}}
<script>
document.getElementById('addItem').addEventListener('click', function () {
    const row = document.querySelector('.item-row').outerHTML;
    document.getElementById('menuItems').insertAdjacentHTML('beforeend', row);
});

document.addEventListener('click', function (e) {
    if(e.target.classList.contains('remove-item')){
        if(document.querySelectorAll('.item-row').length > 1){
            e.target.closest('tr').remove();
        } else {
            alert('At least one item is required.');
        }
    }
});
</script>

@endsection
