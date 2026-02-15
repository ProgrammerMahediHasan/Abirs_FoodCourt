@extends('layout.erp.app')

@section('dashboard')
Welcome to Abir's FoodCourt
@endsection

@section('content')
<div class="container">
    <h2>Edit Category</h2>
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ $category->name }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $category->description }}</textarea>
        </div>

       <button type="submit" class="btn btn-success">
    <i class="fa fa-save"></i> Update
</button>

         <a href="{{ route('categories.index') }}" class="btn btn-secondary">
    <i class="fa fa-arrow-left"></i> Back
</a>

    </form>
</div>
@endsection
