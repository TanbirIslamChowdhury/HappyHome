<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerAuthController extends Controller
{
    public function register(){
        return view('customer.register');
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:150|unique:customers',
            'password' => 'required|string|min:3|confirmed'
        ]);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->password = bcrypt($request->password);
        $customer->save();

        return redirect()->route('customer_panel.login')->with('success', 'Registration successful. Please login.');
    }


    public function login(){
        return view('customer.login');
    }

    public function checkLogin(Request $request){

        $credentials = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if(auth()->guard('customer')->attempt($credentials)){
            return redirect()->route('customer_panel.dashboard');
        }

        return back()->withErrors(['username' => 'Invalid credentials'])->withInput();
    }

    public function dashboard(){
        return view('customer.dashboard');
    }

    public function show($id) {
        $customer =Vendor::findOrFail($id);
        return view('customer.show', compact('customer'));
    }

    public function logout(){
        auth()->guard('customer')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('customer_panel.login');
    }

}
