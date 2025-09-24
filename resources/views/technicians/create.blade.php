@extends('layouts.app_admin')
@section('pageTitle',"technicians list")
@section('content')
 


<div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0 text-primary" >Add New</h5>
                    </div>
                    <div class="card-body">
                      <form method="post" action="{{route('technicians.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label text-primary" for="name">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name"  />
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label text-primary" for="email">Email</label>
                          <div class="col-sm-10">
                            <input
                              type="text" class="form-control" id="email" name="email"
                            />
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label text-primary" for="password">Password</label>
                          <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                              <input
                                type="text" id="password"name="password"  class="form-control"
                              />
                           </div>
                          </div>
                          </div>
                          
                          
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label text-primary" for="phone_number">Phone Number</label>
                          <div class="col-sm-10">
                            <input
                              type="text" id="phone_number" name="phone_number"
                              class="form-control phone-mask"
                            />
                          </div>
                        </div>

                         <div class="row mb-3">
                          <label class="col-sm-2 col-form-label text-primary" for="specialization">Specialization</label>
                          <div class="col-sm-10">
                            <input
                              type="text" id="specialization" name="specialization"
                              class="form-control phone-mask "
                            />
                          </div>
                        </div>
                           <div class="row mb-3">
                          <label class="col-sm-2 col-form-label text-primary" for="phone_number">Certification</label>
                          <div class="col-sm-10">
                            <input
                              type="text" id="certification" name="certification"
                              class="form-control phone-mask"
                            />
                          </div>
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