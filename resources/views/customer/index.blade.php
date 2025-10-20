@extends('layouts.app_admin')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Customer List</h4>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        {{-- <h5 class="card-header"><a href="{{ route('customer.create') }}" class="btn btn-primary m-3">Add New Customer</a></h5> --}}
        
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead>
              <tr>
                <th>#SL</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @forelse ($customers as $data)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->email }}</td>
                <td>{{ $data->password }}</td>
                <td>{{ $data->phone }}</td>
                <td>{{ $data->address }}</td>
                <td>
                 
                      <a class="btn btn-sm btn-info" href="{{ route('customer.edit', $data->id) }}"
                        ><i class=""></i> Edit</a
                      >
                      <form action="{{ route('customer.destroy', $data->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this customer?');">
                          <i class=""></i> Delete
                        </button>
                      </form>
                    
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="5" class="text-center">No customers found.</td>
              </tr>
              @endforelse
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection