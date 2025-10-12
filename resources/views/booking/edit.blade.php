Table bookings {
  id int [pk, increment]
  customer_id int [ref: > customers.id]
  service_id int [ref: > services.id]
  service_package_id int [ref: > service_packages.id]
  provider_id int [ref: > service_providers.id] // assigned by admin
  status enum('pending', 'accepted', 'in-progress', 'completed', 'cancelled') [default: 'pending']
  booking_date datetime
  total_amount decimal(10,2)
  created_at timestamp
  updated_at timestamp
}









@extends('layouts.app_admin')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Update Booking</h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="post" action="{{route('customer.update',$customer->id)}}">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="customer" class="form-label">Customer</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="customer"
                                    placeholder="customer Name"
                                    name="customer"
                                    value="{{old('customer',$customer->name)}}"
                                />
                                @error('customer')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="service" class="form-label">Service</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="service"
                                    placeholder="service"
                                    name="email"
                                    value=""
                                />
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="service_package" class="form-label">Service Package</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="service_package"
                                    placeholder="   service_package"
                                    name="  service_package"
                                    value="{{old('   ',$customer->password)}}"
                                />
                                @error('service_package')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="phone"
                                    placeholder="phone"
                                    name="phone"
                                    value="{{old('phone',$customer->phone)}}"
                                />
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="col-sm-6">
                                <label for="address" class="form-label">Address</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="address"
                                    placeholder="address"
                                    name="address"
                                    value="{{old('address',$customer->address)}}"
                                />
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                        <button type="submit" class="btn btn-primary mt-3">Save</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->


@endsection