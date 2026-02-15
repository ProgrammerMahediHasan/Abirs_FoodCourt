@extends('layout.erp.app')

@section('dashboard')
Welcome to Abir's FoodCourt
@endsection

@section('content')

<div class="container">

    <center><h2>Category List</h2></center>

   <a href="{{ route('categories.create') }}" class="btn mb-3"
   style="color: #000000be; background-color: #FF7F50; border-color: #FF7F50; font-weight: 500; transition: all 0.3s ease;">
    <i class="fa fa-plus"></i> Add New Category</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle table-bordered">
            <thead class="table-dark text-center">
                <tr>
                    <th style="background-color: #FF7F50;color:#000000;" width="60">Id</th>
                    <th style="background-color: #FF7F50;color:#000000;">Name</th>
                    <th style="background-color: #FF7F50;color:#000000;">Description</th>
                    <th style="background-color: #FF7F50;color:#000000;">Status</th>
                    <th style="background-color: #FF7F50;color:#000000;" width="140">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td class="text-center">{{ $category->id }}</td>

                    <td class="fw-semibold">{{ $category->name }}</td>

                    <td class="text-muted">
                        {{ $category->description }}
                    </td>

                    <td class="text-center">
                        @if($category->status)
                            <span class="badge rounded-pill bg-success">
                                Active
                            </span>
                        @else
                            <span class="badge rounded-pill bg-danger">
                                Inactive
                            </span>
                        @endif
                    </td>

                    <td class="text-center">
                        <a href="{{ route('categories.edit', $category->id) }}"
                           class="btn btn-sm"
                           title="Edit"
                           style="border:1px solid #0088cc; color:#0088cc;">
                            <i class="fa fa-edit"></i>
                        </a>

                        <form action="{{ route('categories.destroy', $category->id) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-sm"
                                    title="Delete"
                                    style="border:1px solid #dc3545; color:#dc3545;"
                                    onclick="return confirm('Are you sure you want to delete this category?')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
<!-- Pagination -->
<div class="row">
    <div class="col-md-12 d-flex justify-content-center">
        {{ $categories->links() }}
    </div>
</div>


    </div>

</div>
@endsection
