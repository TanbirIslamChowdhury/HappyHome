




@extends('layouts.app_admin')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Add New Area Distance</h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('area_distance.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="name" class="form-label">From Area</label>
                                <select
                                    class="form-control"
                                    id="from_area_id"
                                    placeholder="from_area_id"
                                    name="from_area_id"
                                >
                                    <option value="">Select Area</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}" {{ old('from_area_id') == $area->id ? 'selected' : '' }}>
                                            {{ $area->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('from_area_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="name" class="form-label">To Area ID</label>
                                <select
                                    class="form-control"
                                    id="to_area_id"
                                    placeholder="to_area_id"
                                    name="to_area_id"
                                >
                                    <option value="">Select Area</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}" {{ old('to_area_id') == $area->id ? 'selected' : '' }}>
                                            {{ $area->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('to_area_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="name" class="form-label">Distance(km)</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="distance_km"
                                    placeholder="distance_km"
                                    name="distance_km"
                                    value="{{old('distance_km')}}"
                                />
                                @error('distance_km')
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