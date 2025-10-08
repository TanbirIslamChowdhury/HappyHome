Table services {
  id int [pk, increment]
  name varchar(100)
  description text
  billing_type enum('area', 'hour', 'distance', 'sqft', 'custom')
  created_at timestamp
  updated_at timestamp
}

@extends('layouts.app_admin')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Service List</h4>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <h5 class="card-header"><a href="{{ route('service.create') }}" class="btn btn-primary m-3">Add New Service</a></h5>
        
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach($service as $service)
              <tr>
                <td>{{ $service->id }}</td>
                <td>{{ $service->name }}</td>
                <td>{{ $service->description }}</td>
              
                <td>
                  <a href="{{ route('service.edit', $service->id) }}" class="btn btn-sm btn-warning">Edit</a>
                  <form action="{{ route('service.destroy', $service->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
