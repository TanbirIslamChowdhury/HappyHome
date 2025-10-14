@extends('layouts.master')
@section('content')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                
                <h1 class="mb-5">Client Signup</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <form action="">
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" placeholder="Your Username">
                                </div>

                                 <div class="col-12 col-sm-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" placeholder="Your Email">
                                </div>
                                
                                <div class="col-12 col-sm-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Your Password">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Your Password">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="phone" placeholder="Your Phone">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" placeholder="Your Address">
                                </div>

                                
                                
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Sign Up</button>
                                </div>
                              
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>






    </div>    <!-- Contact End -->
@endsection 
@section('title')
    Client Login
@endsection
@section('active_login')
    active
@endsection
@section('active_home')
@endsection
@section('active_products')
@endsection
@section('active_about')
@endsection
@section('active_contact')
@endsection
@section('active_dashboard')
@endsection
@section('active_register')
@endsection
@section('active_services')
@endsection
@section('active_team')
@endsection

@section('active_faq')
@endsection
@section('active_testimonial')
@endsection
@section('active_privacy')
@endsection
@section('active_terms')
@endsection

@section('active_blog')
@endsection
@section('active_single_blog')
@endsection
@section('active_cart')
@endsection
@section('active_checkout')
@endsection
@section('active_search')
@endsection
@section('active_error')
@endsection
