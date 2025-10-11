
@extends('layouts.app_admin')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Area Distance List</h4>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <h5 class="card-header"><a href="{{ route('area_distance.create') }}" class="btn btn-primary m-3">Add New Area Distance</a></h5>
        
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead>
              <tr>
                <th>#SL</th>
                <th>From Area</th>
                <th>To Area</th>
                <th>Distance (km)</th>
                <th>Actions</th>
              </tr>
            <tbody class="table-border-bottom-0">
              @forelse ($distances as $data)
              <tr>
                <td>{{ $loop->iteration }}</td> 
                <td>{{ $data->fromArea->name }}</td>
                <td>{{ $data->toArea->name }}</td>
                <td>{{ $data->distance_km }}</td>
                
                <td>
                 
                      <a class="btn btn-sm btn-info" href="{{ route('area_distance.edit', $data->id) }}"
                        ><i class=""></i> Edit</a
                      >
                      <form
                        action="{{ route('area_distance.destroy', $data->id) }}"
                        method="POST"
                        style="display: inline-block"
                        onsubmit="return confirm('Are you sure you want to delete this distance?');"
                      >
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                          Delete
                        </button>
                    
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
