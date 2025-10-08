@extends('layouts.app_admin')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Add New Service</h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('service.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Service Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="billing_type" class="form-label">Billing Type</label>
                            <select class="form-select" id="billing_type" name="billing_type" required>
                                <option value="area">Area</option>
                                <option value="hour">Hour</option>
                                <option value="distance">Distance</option>
                                <option value="sqft">Square Feet</option>
                                <option value="custom">Custom</option>
                            </select>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->


@endsection