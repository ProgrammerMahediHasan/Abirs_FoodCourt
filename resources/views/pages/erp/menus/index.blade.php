@extends('layout.erp.app')

@section('dashboard')
Welcome to Abir's FoodCourt
@endsection

@section('content')

<div class="container">

    <center>
        <h2>Menu Items</h2>
    </center>

    <!-- Add New Menu Button -->
    <a href="{{ route('menus.create') }}" class="btn mb-3"
        style="color: #000000be; background-color: #FF7F50; border-color: #FF7F50; font-weight: 500; transition: all 0.3s ease;">
        <i class="fa fa-plus"></i> Add New Menu
    </a>

    <!-- Success Message -->
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Menu Table -->
    <div class="table-responsive">
        <table class="table table-hover align-middle table-bordered">
            <thead class="table-dark text-center">
                <tr>
                    <th style="background-color: #FF7F50;color:#000000;" width="50">Id</th>
                    <th style="background-color: #FF7F50;color:#000000;">Category</th>
                    <th style="background-color: #FF7F50;color:#000000;">Name</th>
                    <th style="background-color: #FF7F50;color:#000000;">Description</th>
                    <th style="background-color: #FF7F50;color:#000000;" class="text-end">Price ($)</th>
                    <th style="background-color: #FF7F50;color:#000000;">Status</th>
                    <th style="background-color: #FF7F50;color:#000000;">Image</th>
                    <th style="background-color: #FF7F50;color:#000000;" width="140">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($menus as $menu)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $menu->category->name ?? 'N/A' }}</td>
                    <td class="fw-semibold">{{ $menu->name }}</td>
                    <td class="text-muted">{{ Str::limit($menu->description, 50) }}</td>
                    <td class="text-end fw-bold">{{ number_format($menu->price, 2) }}</td>
                    <td class="text-center">
                        @if($menu->status)
                        <span class="badge rounded-pill bg-success">Active</span>
                        @else
                        <span class="badge rounded-pill bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($menu->image)
                        <img src="{{ asset('storage/' . $menu->image) }}"
                            alt="{{ $menu->name }}"
                            class="rounded border"
                            width="55" height="55"
                            style="object-fit: cover;">
                        @else
                        <span class="text-muted">N/A</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('menus.edit', $menu->id) }}"
                            class="btn btn-sm"
                            style="border:1px solid #0088cc; color:#0088cc;">
                            <i class="fa fa-edit"></i>
                        </a>

                        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-sm"
                                style="border:1px solid #dc3545; color:#dc3545;"
                                onclick="return confirm('Are you sure you want to delete this menu item?')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        No menu items found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                {{ $menus->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
