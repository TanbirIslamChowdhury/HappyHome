<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a list of all customers.
     */
    public function index()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    /**
     * Store (Register) a new customer.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:customers,email',
            'password' => 'required|string|min:6|confirmed',
            'phone'    => 'required|string|max:20',
            'address'  => 'required|string|max:255',
        ]);

        $customer = Customer::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'phone'    => $request->phone,
            'address'  => $request->address,
        ]);

        return response()->json(['message' => 'Customer registered successfully', 'customer' => $customer], 201);
    }

    /**
     * Display a specific customer.
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }

    /**
     * Update customer profile.
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'name'     => 'sometimes|string|max:255',
            'email'    => 'sometimes|string|email|unique:customers,email,' . $customer->id,
            'password' => 'nullable|string|min:6|confirmed',
            'phone'    => 'sometimes|string|max:20',
            'address'  => 'sometimes|string|max:255',
        ]);

        $customer->fill($request->only(['name', 'email', 'phone', 'address']));

        if ($request->filled('password')) {
            $customer->password = Hash::make($request->password);
        }

        $customer->save();

        return response()->json(['message' => 'Customer updated successfully', 'customer' => $customer]);
    }

    /**
     * Delete a customer.
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return response()->json(['message' => 'Customer deleted successfully']);
    }

    /**
     * Customer login.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $customer = Customer::where('email', $request->email)->first();

        if (!$customer || !Hash::check($request->password, $customer->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // If using Laravel Sanctum or Passport, you can generate token:
        $token = $customer->createToken('CustomerAuthToken')->plainTextToken;

        return response()->json([
            'message'  => 'Login successful',
            'token'    => $token,
            'customer' => $customer,
        ]);
    }

    /**
     * Customer logout.
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
