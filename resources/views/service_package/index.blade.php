@extends('layouts.app_admin')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Service package List</h4>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <h5 class="card-header"><a href="{{ route('service_package.create') }}" class="btn btn-primary m-3">Add New Service package</a></h5>
        
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead>
              <tr>
                <th>#SL</th>
                <th>Service ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Base Price</th>
                <th>Unit Price</th>
                <th>Actions</th>
              </tr>
            <tbody class="table-border-bottom-0">
              @forelse ($packages as $data)
              
              <tr>
                <td>{{ $loop->iteration }}</td> 
                <td>{{ $data->service->name }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->description }}</td>
                <td>{{ $data->base_price }}</td>
                <td>{{ $data->unit_price }}</td>                
                <td>
                 
                      <a class="btn btn-sm btn-info" href="{{ route('service_package.edit', $data->id) }}"
                        ><i class=""></i> Edit</a
                      >
                      <form action="{{ route('service_package.destroy', $data->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this package?');">
                          <i class=""></i> Delete
                        </button>
                      </form>
                    
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="5" class="text-center">No package found.</td>
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
