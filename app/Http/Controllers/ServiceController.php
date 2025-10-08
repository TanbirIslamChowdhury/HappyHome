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
            $service = Service::all();
        return view('service.index', compact('service'));
    }
    public function create()
    {
        return view('service.create');
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

        return redirect()->route('service.index')->with('success', 'Service created successfully');
    }

    /**
     * Display the specified service.
     */
    public function show($id)
    {
        $service = Service::with('packages')->findOrFail($id);
        return response()->json($service);
    }
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('service.edit', compact('service'));
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

        $service->update($request->all());

        return redirect()->route('service.index')->with('success', 'Service updated successfully');
    }

    /**
     * Remove the specified service.
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return  redirect()->route('service.index')->with('success', 'Service deleted successfully');
    }
}

    /**
     * Toggle service active/inactive status.
     */
   
