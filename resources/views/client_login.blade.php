Table customers {
  id int [pk, increment]
  name varchar(100)
  email varchar(150) [unique]
  password varchar(255)
  phone varchar(20)
  address text
  created_at timestamp
  updated_at timestamp
}







@extends('layouts.master')
@section('content')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                
                <h1 class="mb-5">Client Login</h1>
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
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Your Password">
                                </div>
                                
                                
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Login</button>
                                </div>
                                <div class="col-12">
                                    <a href="#">Forgot Password?</a>
                                </div>
                                <div class="col-12">
                                    <p class="mb-0">Don't have an Account? <a href="client_signup">Sign Up</a></p>
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
