@extends('layout.erp.app')

@section('dashboard')
Welcome to Abir's FoodCourt
@endsection

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between mb-3">
        <h3>Product Stocks List</h3>
        <a href="{{ route('stocks.create') }}" class="btn" style="background-color:coral; color:black">Add New Stock</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead  >
            <tr>
                <th style="background-color:coral">SlNo</th>
                <th style="background-color:coral">Menu Item</th>
                <th style="background-color:coral">Stock Quantity</th>
                <th style="background-color:coral">Unit</th>
                <th style="background-color:coral">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stocks as $stock)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $stock->menu->name }}</td>
                <td>{{ $stock->current_quantity }}</td>
                <td>{{ $stock->unit }}</td>
                <td>
                    <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-success btn-sm">Edit</a>
                    <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" class="d-inline btn-danger"
                        onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $stocks->links() }}
</div>
@endsection
