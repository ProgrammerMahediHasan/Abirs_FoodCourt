@extends('layout.erp.app')

@section('dashboard')
Customers
@endsection

@section('content')

<div class="container">

    <center><h2>Customers Details</h2></center>

    <a href="{{ route('customer.create')}}" class="btn mb-3"
   style="color: #000000be; background-color: #FF7F50; border-color: #FF7F50; font-weight: 500; transition: all 0.3s ease;">
    <i class="fa fa-plus"></i> Add New Customer</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

<div class="table-responsive">
    <table class="table table-hover align-middle table-bordered">
            <thead class="table-dark text-center">
                <tr>
                    <th style="background-color: #FF7F50;color:#000000;" width="50">ID</th>
                    <th style="background-color: #FF7F50;color:#000000;">Name</th>
                    <th style="background-color: #FF7F50;color:#000000;">Email</th>
                    <th style="background-color: #FF7F50;color:#000000;">Phone</th>
                    <th style="background-color: #FF7F50;color:#000000;">Address</th>
                    <th style="background-color: #FF7F50;color:#000000;">Status</th>
                    <th style="background-color: #FF7F50;color:#000000;" width="140">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($customers as $customer)
                <tr>
                    <td class="text-center">{{ $customer->id }}</td>
                    <td class="fw-semibold">{{ $customer->name }}</td>
                    <td>{{ $customer->email ?? 'N/A' }}</td>
                    <td>{{ $customer->phone ?? 'N/A' }}</td>
                    <td>{{ $customer->address ?? 'N/A' }}</td>

                    <td class="text-center">
                        @if($customer->status)
                            <span class="badge rounded-pill bg-success">Active</span>
                        @else
                            <span class="badge rounded-pill bg-danger">Inactive</span>
                        @endif
                    </td>

                    <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center gap-1">
                            <a href="{{ route('customer.edit', $customer->id) }}"
                               class="btn btn-sm"
                               style="border:1px solid #0088cc; color:#0088cc;"
                               title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>

                            <form action="{{ route('customer.destroy', $customer->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm"
                                        style="border:1px solid #dc3545; color:#dc3545;"
                                        title="Delete"
                                        onclick="return confirm('Are you sure you want to delete this customer?')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">No customers found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    {{ $customers->links() }}
                </div>
            </div>

    </div>

</div>

@endsection
