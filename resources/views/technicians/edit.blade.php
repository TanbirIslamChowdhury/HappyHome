@extends('layouts.app_admin')
@section('pageTitle','Edit technicians')
@section('content')
<div class="body-wrapper-inner">
    <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
            <h3>Update Technicians</h3>
                <form action="{{route('technicians.update', $technicians->id)}}" method="post"  enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name"  value="{{$technicians->name}}">
                </div>

                 <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{$technicians->email}}">
                </div>

                 <div class="form-group">
                    <label for="price">Password</label>
                    <input type="text" class="form-control" id="password" name="password"  value="{{$technicians->password}}">
                </div>
                  <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number"  value="{{$technicians->phone_number}}">
                </div>
              <div class="form-group">
                    <label for="specialization">Specialization</label>
                    <input type="file" class="form-control" id="specialization" name="specialization"  value="{{$technicians->specialization}}">
                </div>








                <button type="submit" class="btn btn-info mt-3">Submit</button>
                </form>
        </div>
        </div>

    </div>
</div>
@endsection