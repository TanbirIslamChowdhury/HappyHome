@extends('layouts.app_admin')
@section('pageTitle',"technicians list")
@section('content')
 


<div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0 text-primary btn btn-info" >Add New</h5>
                    </div>
                    
                    <div class="card-body">
                      <form method="post" action="{{route('service_types.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label text-primary" for="name">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name"  />
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label text-primary" for="description">Description</label>
                          <div class="col-sm-10">
                            <input
                              type="text" class="form-control" id="description" name="description"
                            />
                          </div>
                        </div>
                       
                        
                        <div class="row justify-content-end">
                          <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
@endsection