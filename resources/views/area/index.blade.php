
@extends('layouts.app_admin')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Area List</h4>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <h5 class="card-header"><a href="{{ route('area.create') }}" class="btn btn-primary m-3">Add New Area</a></h5>
        
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead>
              <tr>
                <th>#SL</th>
                <th>Name</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @forelse ($areas as $data)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->latitude }}</td>
                <td>{{ $data->longitude }}</td>
                <td>
                 
                      <a class="btn btn-info" href="{{ route('area.edit', $data->id) }}"
                        ><i class="bx bx-edit-alt me-1"></i> Edit</a
                      >
                      <form action="{{ route('area.destroy', $data->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this area?');">
                          <i class="bx bx-trash me-1"></i> Delete
                        </button>
                      </form>
                    
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="5" class="text-center">No areas found.</td>
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
