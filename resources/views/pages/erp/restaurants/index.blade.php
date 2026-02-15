
@extends('layout.erp.app')

@section('dashboard')
Welcome to Abir's FoodCourt
@endsection
@section('content')
<div class="container">

   <center><h2>Restaurants List</h2></center>

    <a href="{{ route('restaurants.create')}}" class="btn mb-3"
   style="color: #000000be; background-color: #FF7F50; border-color: #FF7F50; font-weight: 500; transition: all 0.3s ease;">
    <i class="fa fa-plus"></i> Add New Restaurant</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
    <table class="table table-hover align-middle table-bordered">
            <thead class="table-dark text-center">
                <tr>
                    <th style="background-color: #FF7F50;color:#000000;">Id</th>
                    <th style="background-color: #FF7F50;color:#000000;">Name</th>
                    <th style="background-color: #FF7F50;color:#000000;">Email</th>
                    <th style="background-color: #FF7F50;color:#000000;">Phone</th>
                    <th style="background-color: #FF7F50;color:#000000;">Address</th>
                    <th style="background-color: #FF7F50;color:#000000;">Status</th>
                    <th style="background-color: #FF7F50;color:#000000;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($restaurants as $restaurant)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $restaurant->name }}</td>
                        <td>{{ $restaurant->email ?? '-' }}</td>
                        <td>{{ $restaurant->phone ?? '-' }}</td>
                        <td>{{ $restaurant->address ?? '-' }}</td>
                    <td>
                    @if($restaurant->status == 1)
                    <span class="badge bg-success">Active</span>
                    @else
                    <span class="badge bg-danger">Inctive</span>
                    @endif
                    </td>


<td class="text-center">
    <div class="d-flex justify-content-center align-items-center gap-1">
        {{-- Edit Button --}}
        <a href="{{ route('restaurants.edit', $restaurant->id) }}"
           class="btn btn-sm"
              style="border:1px solid #0088cc; color:#0088cc;">

            <i class="fa fa-edit"></i>
        </a>

        {{-- Delete Button --}}
        <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="btn btn-sm"
                    style="border:1px solid #dc3545; color:#dc3545;"
                    title="Delete"
                    onclick="return confirm('Are you sure you want to delete this restaurant?')">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    </div>
</td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No Restaurants Found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
            <!-- Pagination -->
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                {{ $restaurants->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
