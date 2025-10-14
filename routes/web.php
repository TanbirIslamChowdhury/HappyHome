<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\UserController;

use App\Http\Controllers\CustomerController;

use App\Http\Controllers\ServiceProviderController;

use App\Http\Controllers\ServiceController;

use App\Http\Controllers\ServicePackageController;

use App\Http\Controllers\AreaController;

use App\Http\Controllers\AreaDistanceController;

use App\Http\Controllers\BookingController;

use App\Http\Controllers\BookingDetailController;

use App\Http\Controllers\FeedbackController;

use App\Http\Controllers\ProviderRatingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/services', function () {
    return view('services');
})->name('services');

// Route::get('/home', function () {
//     return view('home');
// })->name('home');



Route::get('/about', function () {
    return view('about');
})->name('about');


Route::get('/contact', function () {
    return view('contact');
})->name('contact');





Route::get('/client_login', function () {
    return view('client_login');
})->name('client_login');




Route::get('/client_signup', function () {
    return view('client_signup');
})->name('client_signup);');


// Route::get('/front_products',function(){
//     return view('products');
// })->name('front_products');

//admin routes










// Route::get('/admin_technicians', function () {
//      return view('admin_technicians');
//  })->name('admin_technicians');



//  Route::get('/admin_users', function () {
//      return view('admin_users');
//  })->name('admin_users');



Auth::routes();

Route::middleware(['auth'])->group(function(){
    Route::resource('user', UserController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('service_provider', ServiceProviderController::class);
    Route::resource('service', ServiceController::class);
    Route::resource('service_package', ServicePackageController::class);
    Route::resource('area', AreaController::class);
    Route::resource('area_distance', AreaDistanceController::class);
    Route::resource('booking', BookingController::class);
    Route::resource('booking_detail', BookingDetailController::class);
    Route::resource('feedback', FeedbackController::class);
    Route::resource('provider_rating', ProviderRatingController::class);
  Route::get('/admin', [App\Http\Controllers\UserController::class, 'index'])->name('admin');
//  Route::get('/customers', [App\Http\Controllers\CustomerController::class, 'index'])->name('customers');
//   Route::resource('users', UserController::class);

});




// Route::middleware(['auth'])->group(function () {
//     Route::resource('users', UserController::class);
// });

