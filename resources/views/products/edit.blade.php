@extends('layouts.app_admin')
@section('pageTitle','Edit products')
@section('content')
<div class="body-wrapper-inner">
    <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
            <h3>Update products</h3>
                <form action="{{route('products.update', $products->id)}}" method="post">
                    @csrf
                    @method('PATCH')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name"  value="{{$products->name}}">
                </div>

                 <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{$products->description}}">
                </div>

                 <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" name="price"  value="{{$products->price}}">
                </div>
                  <div class="form-group">
                    <label for="stock_quantity">Stock Quantity</label>
                    <input type="text" class="form-control" id="stock_quantity" name="stock_quantity"  value="{{$products->price}}">
                </div>








                <button type="submit" class="btn btn-info mt-3">Submit</button>
                </form>
        </div>
        </div>

    </div>
</div>
@endsection