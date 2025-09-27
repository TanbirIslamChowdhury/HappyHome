@extends('layouts.app_admin')
@section('pageTitle','Edit Service Types')
@section('content')
<div class="body-wrapper-inner">
    <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
            <h3 class="text-primary">Update Services</h3>
                <form action="{{route('service_types.update', $service_types->id)}}" method="post"  enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name"  value="{{$service_types->name}}">
                </div>

                 <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="email" value="{{$service_types->description}}">
                </div>







                <button type="submit" class="btn btn-info mt-3">Submit</button>
                </form>
        </div>
        </div>

    </div>
</div>
@endsection