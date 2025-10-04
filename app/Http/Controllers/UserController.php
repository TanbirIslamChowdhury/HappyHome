<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of admins.
     */
    public function index()
    {
        $admins = User::where('role', 'admin')->get();
        return response()->json($admins);
    }

    /**
     * Store a newly created admin.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $admin = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'admin',
        ]);

        return response()->json(['message' => 'Admin created successfully', 'admin' => $admin], 201);
    }

    /**
     * Display the specified admin.
     */
    public function show($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        return response()->json($admin);
    }

    /**
     * Update the specified admin.
     */
    public function update(Request $request, $id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);

        $request->validate([
            'name'     => 'sometimes|string|max:255',
            'email'    => 'sometimes|string|email|unique:users,email,' . $admin->id,
            'password' => 'nullable|string|min:6',
        ]);

        $admin->name  = $request->name ?? $admin->name;
        $admin->email = $request->email ?? $admin->email;

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return response()->json(['message' => 'Admin updated successfully', 'admin' => $admin]);
    }

    /**
     * Remove the specified admin.
     */
    public function destroy($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        $admin->delete();

        return response()->json(['message' => 'Admin deleted successfully']);
    }
}
