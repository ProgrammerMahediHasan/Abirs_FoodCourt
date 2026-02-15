@extends('layout.erp.app')

@section('dashboard')
Welcome to Abir's FoodCourt
@endsection

@section('content')

<div class="container">

    <center><h2>Edit Restaurant</h2></center>

    <a href="{{ route('restaurants.index') }}" class="btn btn-secondary mb-3">
        <i class="fa fa-arrow-left"></i> Back to List
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
        <form action="{{ route('restaurants.update', $restaurant->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Restaurant Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter restaurant name" value="{{ old('name', $restaurant->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ old('email', $restaurant->email) }}">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number" value="{{ old('phone', $restaurant->phone) }}">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter address">{{ old('address', $restaurant->address) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="1" {{ old('status', $restaurant->status) == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status', $restaurant->status) == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="d-flex justify-content-start gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Update
                </button>
                <a href="{{ route('restaurants.index') }}" class="btn btn-secondary">
                    <i class="fa fa-times"></i> Cancel
                </a>
            </div>

        </form>
    </div>

</div>

@endsection
