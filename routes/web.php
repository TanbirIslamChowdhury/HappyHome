<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TechniciansController;

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

Route::get('/front_products',function(){
    return view('products');
})->name('front_products');

//admin routes

Route::get('/admin_orders', function () {
     return view('admin_orders');
 })->name('admin_orders');



 Route::get('/admin_bookings', function () {
     return view('admin_bookings');
 })->name('admin_bookings');



// Route::get('/admin_technicians', function () {
//      return view('admin_technicians');
//  })->name('admin_technicians');



 Route::get('/admin_users', function () {
     return view('admin_users');
 })->name('admin_users');



Auth::routes();

Route::middleware('auth:web')->group(function(){
  Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
  Route::resource('products', ProductsController::class);
  Route::resource('technicians', TechniciansController::class);

});


