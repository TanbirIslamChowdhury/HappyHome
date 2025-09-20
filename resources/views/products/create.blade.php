@extends('layouts.app_admin')
@section('pageTitle',"Products list")
@section('content')
 


<div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0">Add New</h5>
                    </div>
                    <div class="card-body">
                      <form method="post" action="{{route('products.store')}}">
                        @csrf
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="name">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" name="name"  />
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="description">Description</label>
                          <div class="col-sm-10">
                            <input
                              type="text"
                              class="form-control"
                              id="description"
                              name="description"
                            />
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="price">Price</label>
                          <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                              <input
                                type="text"
                                id="price"name="price"
                                class="form-control"
                              />
                        </div>
                          </div>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="stock_quantity">Stock Quantity</label>
                          <div class="col-sm-10">
                            <input
                              type="text"
                              id="stock_quantity"
                              name="stock_quantity"
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