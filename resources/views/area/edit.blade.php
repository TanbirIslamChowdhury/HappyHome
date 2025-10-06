
@extends('layouts.app_admin')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Update Area</h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form method="post" action="{{route('area.update',$area->id)}}">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="name" class="form-label">Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    placeholder="Area Name"
                                    name="name"
                                    value="{{old('name',$area->name)}}"
                                />
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="name" class="form-label">Latitude</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="latitude"
                                    placeholder="Latitude"
                                    name="latitude"
                                    value="{{old('latitude',$area->latitude)}}"
                                />
                                @error('latitude')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="name" class="form-label">Longitude</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="longitude"
                                    placeholder="Longitude"
                                    name="longitude"
                                    value="{{old('longitude',$area->longitude)}}"
                                />
                                @error('longitude')
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