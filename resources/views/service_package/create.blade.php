
Table service_packages {
  id int [pk, increment]
  service_id int [ref: > services.id]
  name varchar(100)
  description text
  base_price decimal(10,2)
  unit_price decimal(10,2)
  created_at timestamp
  updated_at timestamp
}



























@extends('layouts.app_admin')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Add New package</h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('service_package.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="name" class="form-label">Service ID</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="service_id"
                                    placeholder="service_id"
                                    name="service_id"
                                    value="{{ $service->id }}"
                                    
                                    />
                                @error('service_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="name" class="form-label">Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    placeholder="name"
                                    name="name"
                                    
                                    value="{{ $service->name }}"



                                />  
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="name" class="form-label">Description</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="description"
                                    placeholder="description"
                                    name="description"
                                    value="{{ $service->description}}"
                                />
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="name" class="form-label">Base Price</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="base_price"
                                    placeholder="base_price"
                                    name="base_price"
                                    value="{{old('base_price')}}"
                                />
                                @error('base_price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="name" class="form-label">Unit Price</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="unit_price"
                                    placeholder="unit_price"
                                    name="unit_price"
                                    value="{{old('unit_price')}}"
                                />
                                @error('unit_price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
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