
@extends('layouts.app_admin')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Update Booking</h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="post" action="{{route('booking.update',$booking->id)}}">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="status" class="form-label">Status</label>
                                <select
                                    class="form-control"
                                    id="status"
                                    name="status"
                                >
                                    <option value="pending" {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                   
                                    <option value="completed" {{ old('status', $booking->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                   
                                </select>
                                @error('status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                           
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update Booking</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->


@endsection