<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of services.
     */
    public function index()
    {
        $services = Service::with('packages')->get();
        return response()->json($services);
    }

    /**
     * Store a newly created service.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255|unique:services,name',
            'description' => 'nullable|string|max:1000',
            'is_active'   => 'boolean',
        ]);

        $service = Service::create([
            'name'        => $request->name,
            'description' => $request->description,
            'is_active'   => $request->is_active ?? true,
        ]);

        return response()->json([
            'message' => 'Service created successfully',
            'service' => $service,
        ], 201);
    }

    /**
     * Display the specified service.
     */
    public function show($id)
    {
        $service = Service::with('packages')->findOrFail($id);
        return response()->json($service);
    }

    /**
     * Update the specified service.
     */
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'name'        => 'sometimes|string|max:255|unique:services,name,' . $id,
            'description' => 'nullable|string|max:1000',
            'is_active'   => 'boolean',
        ]);

        $service->update([
            'name'        => $request->name ?? $service->name,
            'description' => $request->description ?? $service->description,
            'is_active'   => $request->is_active ?? $service->is_active,
        ]);

        return response()->json([
            'message' => 'Service updated successfully',
            'service' => $service,
        ]);
    }

    /**
     * Remove the specified service.
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return response()->json(['message' => 'Service deleted successfully']);
    }

    /**
     * Toggle service active/inactive status.
     */
    public function toggleStatus($id)
    {
        $service = Service::findOrFail($id);
        $service->is_active = !$service->is_active;
        $service->save();

        return response()->json([
            'message' => 'Service status updated successfully',
            'service' => $service,
        ]);
    }
}
