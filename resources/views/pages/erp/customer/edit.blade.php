@extends('layout.erp.app')

@section('dashboard')
Welcome to Abir's FoodCourt
@endsection

@section('content')

<div class="container">

    <center><h2>Edit Customer</h2></center>

    <a href="{{ route('customer.index') }}" class="btn btn-secondary mb-3">
        <i class="fa fa-arrow-left"></i> Back to Customer List
    </a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card p-4">
        <form action="{{ route('customer.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Customer Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $customer->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $customer->email) }}">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $customer->phone) }}">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea name="address" id="address" class="form-control">{{ old('address', $customer->address) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="1" {{ old('status', $customer->status) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status', $customer->status) == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fa fa-edit"></i> Update Customer
            </button>
        </form>
    </div>

</div>

@endsection
