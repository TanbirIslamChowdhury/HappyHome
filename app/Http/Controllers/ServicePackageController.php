<?php

namespace App\Http\Controllers;

use App\Models\ServicePackage;
use App\Models\Service;
use Illuminate\Http\Request;

class ServicePackageController extends Controller
{
    /**
     * Display a listing of service packages.
     */
    public function index()
    {
        $packages = ServicePackage::with('service')->get();
        return view('service_package.index', compact('packages'));
    }
    public function create()
    {
        $services = Service::all();
        return view('service_package.create', compact('services'));
    }


    /**
     * Store a newly created service package.
     */
    public function store(Request $request)
    {
        $request->validate([
            'service_id'      => 'required|exists:services,id',
            'name'            => 'required|string|max:255',
            'description'     => 'nullable|string|max:1000',
            'price_type'      => 'required|in:hourly,per_sqft,per_distance,per_area,fixed',
            'base_price'      => 'required|numeric|min:0',
            'unit_price'      => 'nullable|numeric|min:0',
            'min_unit'        => 'nullable|numeric|min:0',
            'max_unit'        => 'nullable|numeric|min:0',
            'is_active'       => 'boolean',
        ]);

        $package = ServicePackage::create([
            'service_id'  => $request->service_id,
            'name'        => $request->name,
            'description' => $request->description,
            'price_type'  => $request->price_type,
            'base_price'  => $request->base_price,
            'unit_price'  => $request->unit_price,
            'min_unit'    => $request->min_unit,
            'max_unit'    => $request->max_unit,
            'is_active'   => $request->is_active ?? true,
        ]);

        return redirect()->route('service_package.index')->with('success', 'Service package created successfully');
    }


    /**
     * Display the specified service package.
     */
    public function show($id)
    {
        $package = ServicePackage::with('service')->findOrFail($id);

    }

    public function edit($id)
    {
        $package = ServicePackage::findOrFail($id);
        $services = Service::all();
        return view('service_package.edit', compact('package', 'services'));
    }


    /**
     * Update the specified service package.
     */
    public function update(Request $request, $id)
    {
        $package = ServicePackage::findOrFail($id);

        $request->validate([
            'service_id'      => 'sometimes|exists:services,id',
            'name'            => 'sometimes|string|max:255',
            'description'     => 'nullable|string|max:1000',
            'price_type'      => 'sometimes|in:hourly,per_sqft,per_distance,per_area,fixed',
            'base_price'      => 'sometimes|numeric|min:0',
            'unit_price'      => 'nullable|numeric|min:0',
            'min_unit'        => 'nullable|numeric|min:0',
            'max_unit'        => 'nullable|numeric|min:0',
            'is_active'       => 'boolean',
        ]);

        $package->update($request->all());

        return redirect()->route('service_package.index')->with('success', 'Service package updated successfully');
    }


    /**
     * Remove the specified service package.
     */
    public function destroy($id)
    {
        $package = ServicePackage::findOrFail($id);
        $package->delete();

        return redirect ()->route('service_package.index')->with('success', 'Service package deleted successfully');
    }


    /**
     * List packages by specific service.
     */
   }
