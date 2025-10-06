<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\AreaDistance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AreaController extends Controller
{
    /**
     * Display all areas.
     */
    public function index()
    {
        $areas = Area::all();
        return view('area.index', compact('areas'));
    }

    public function create()
    {
        return view('area.create');
    }

    /**
     * Store a new area.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255|unique:areas,name',
            'latitude'   => 'required|numeric',
            'longitude'  => 'required|numeric',
            'is_active'  => 'boolean',
        ]);

        $area = Area::create([
            'name'       => $request->name,
            'latitude'   => $request->latitude,
            'longitude'  => $request->longitude,
            'is_active'  => $request->is_active ?? true,
        ]);

       return redirect()->route('area.index')->with('success', 'Area created successfully');
    }

    /**
     * Display a specific area.
     */
    public function show($id)
    {
        $area = Area::findOrFail($id);
        return response()->json($area);
    }

    public function edit($id)
    {
        $area = Area::findOrFail($id);
        return view('area.edit', compact('area'));
    }

    /**
     * Update area details.
     */
    public function update(Request $request, $id)
    {
        $area = Area::findOrFail($id);

        $request->validate([
            'name'       => 'sometimes|string|max:255|unique:areas,name,' . $id,
            'latitude'   => 'sometimes|numeric',
            'longitude'  => 'sometimes|numeric',
            'is_active'  => 'boolean',
        ]);

        $area->update($request->all());

        return redirect()->route('area.index')->with('success', 'Area updated successfully');
    }

    /**
     * Delete an area.
     */
    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        $area->delete();

       return redirect()->route('area.index')->with('success', 'Area deleted successfully');
    }

}
