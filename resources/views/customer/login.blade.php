@extends('layouts.master_customer')
@section('content')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                
                <h1 class="mb-5">Client Login</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <form action="{{route('customer_panel.check')}}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" placeholder="Your Email" name="email">
                                </div>

                                 
                                
                                <div class="col-12 col-sm-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Your Password">
                                </div>
                                
                                
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Login</button>
                                </div>
                                <div class="col-12">
                                    <a href="#">Forgot Password?</a>
                                </div>
                                <div class="col-12">
                                    <p class="mb-0">Don't have an Account? <a href="{{route('customer_panel.register')}}">Sign Up</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>






    </div>    <!-- Contact End -->
@endsection 
