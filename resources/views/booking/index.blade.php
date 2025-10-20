@extends('layouts.app_admin')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Booking List</h4>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
     
        
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead>
              <tr>
                <th>#SL</th>
                <th>Customer</th>
                <th>Service</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @forelse ($bookings as $data)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->customer?->name }}</td>
                <td>{{ $data->service->name }}</td>
                <td>{{ $data->status }}</td>

                <td>
                 
                      <a class="btn btn-sm btn-info" href="{{ route('booking.edit', $data->id) }}"
                        ><i class="btn btn-sm btn-info"></i> Edit</a
                      >
                      {{-- <form action="{{ route('area.destroy', $data->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this area?');">
                          <i class="btn btn-sm btn-danger"></i> Delete
                        </button>
                      </form> --}}
                    
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="5" class="text-center">No booking found.</td>
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
