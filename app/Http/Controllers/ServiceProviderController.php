<?php

namespace App\Http\Controllers;

use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ServiceProviderController extends Controller
{
    /**
     * Display a list of all service providers.
     */
    public function index()
    {
        $providers = ServiceProvider::all();
        return response()->json($providers);
    }

    /**
     * Register a new service provider.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:service_providers,email',
            'password' => 'required|string|min:6|confirmed',
            'phone'    => 'required|string|max:20',
            'address'  => 'required|string|max:255',
        ]);

        $provider = ServiceProvider::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'phone'    => $request->phone,
            'address'  => $request->address,
        ]);

        return response()->json(['message' => 'Service provider registered successfully', 'provider' => $provider], 201);
    }

    /**
     * Display a specific service provider.
     */
    public function show($id)
    {
        $provider = ServiceProvider::findOrFail($id);
        return response()->json($provider);
    }

    /**
     * Update service provider details.
     */
    public function update(Request $request, $id)
    {
        $provider = ServiceProvider::findOrFail($id);

        $request->validate([
            'name'     => 'sometimes|string|max:255',
            'email'    => 'sometimes|string|email|unique:service_providers,email,' . $provider->id,
            'password' => 'nullable|string|min:6|confirmed',
            'phone'    => 'sometimes|string|max:20',
            'address'  => 'sometimes|string|max:255',
        ]);

        $provider->fill($request->only(['name', 'email', 'phone', 'address']));

        if ($request->filled('password')) {
            $provider->password = Hash::make($request->password);
        }

        $provider->save();

        return response()->json(['message' => 'Service provider updated successfully', 'provider' => $provider]);
    }

    /**
     * Delete a service provider.
     */
    public function destroy($id)
    {
        $provider = ServiceProvider::findOrFail($id);
        $provider->delete();

        return response()->json(['message' => 'Service provider deleted successfully']);
    }

    /**
     * Service provider login.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $provider = ServiceProvider::where('email', $request->email)->first();

        if (!$provider || !Hash::check($request->password, $provider->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Generate Sanctum token
        $token = $provider->createToken('ServiceProviderAuthToken')->plainTextToken;

        return response()->json([
            'message'  => 'Login successful',
            'token'    => $token,
            'provider' => $provider,
        ]);
    }

    /**
     * Service provider logout.
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
