@extends('layouts.app_admin')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Add New customer</h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="post" action="{{route('customer.store')}}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="name" class="form-label">Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    placeholder="customer Name"
                                    name="name"
                                    value="{{old('name')}}"
                                />
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="name" class="form-label">Email</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="latitude"
                                    placeholder="email"
                                    name="email"
                                    value="{{old('email')}}"
                                />
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            <div class="col-sm-6">
                                <label for="password" class="form-label">Password</P></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="password"
                                    placeholder="password"
                                    name="password"
                                    value="{{old('password')}}"
                                />
                                @error('password')
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
                                    value="{{old('phone')}}"
                                />
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            
                        </div>
                        
                        <button type="submit" class="btn btn-primary mt-3">Save</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->


@endsection