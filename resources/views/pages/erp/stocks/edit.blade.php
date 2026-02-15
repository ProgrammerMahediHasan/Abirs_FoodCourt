@extends('layout.erp.app')
@section('dashboard')
Welcome to Abir's FoodCourt
@endsection
@section('content')
<div class="container py-4">
    <h3>Edit Stock</h3>

    <form action="{{ route('stocks.update', $stock->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Menu Item</label>
            <select name="menu_id" class="form-select" required>
                <option value="">Select Menu</option>
                @foreach($menus as $menu)
                    <option value="{{ $menu->id }}" {{ $stock->menu_id == $menu->id ? 'selected' : '' }}>{{ $menu->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Available Quantity</label>
            <input type="number" name="current_quantity" class="form-control" value="{{ $stock->current_quantity }}" min="0" required>
        </div>

        <div class="mb-3">
            <label>Unit</label>
            <input type="text" name="unit" class="form-control" value="{{ $stock->unit }}">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('stocks.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
