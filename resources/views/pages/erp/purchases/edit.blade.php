@extends('layout.erp.app')
@section('dashboard')
Welcome to Abir's FoodCourt
@endsection


@section('content')
<div class="container">
    <h2>Edit Purchase Order: {{ $purchase->po_number }}</h2>

    @if($purchase->status != 'draft')
        <div class="alert alert-danger">
            This order cannot be edited. Status: {{ ucfirst($purchase->status) }}
        </div>
    @endif

    <form method="POST" action="{{ route('purchases.update', $purchase->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Supplier</label>
            <select name="supplier_id" class="form-control"
                {{ $purchase->status != 'draft' ? 'disabled' : '' }}>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}"
                        {{ $purchase->supplier_id == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <h4>Items</h4>
            <div id="items">
                @foreach($purchase->items as $index => $item)
                <div class="item-row border p-3 mb-2">
                    <div class="row">
                        <div class="col-md-4">
                            <select name="items[{{ $index }}][product_id]" class="form-control"
                                {{ $purchase->status != 'draft' ? 'disabled' : '' }}>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}"
                                        {{ $item->product_id == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="items[{{ $index }}][quantity]"
                                value="{{ $item->quantity }}" class="form-control"
                                {{ $purchase->status != 'draft' ? 'disabled' : '' }}>
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="items[{{ $index }}][unit_price]"
                                value="{{ $item->unit_price }}" class="form-control"
                                {{ $purchase->status != 'draft' ? 'disabled' : '' }}>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        @if($purchase->status == 'draft')
        <button type="submit" class="btn btn-primary">Update</button>
        @endif

        <a href="{{ route('purchases.show', $purchase->id) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
