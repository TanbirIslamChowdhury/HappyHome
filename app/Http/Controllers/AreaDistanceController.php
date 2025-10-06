<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\AreaDistance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AreaDistanceController extends Controller
{
    /**
     * Display all stored distances.
     */
    public function index()
    {
        $distances = AreaDistance::with(['fromArea', 'toArea'])->get();
        return view('area_distance.index', compact('distances'));
    }

    public function create()
    {
        $areas = Area::all();
        return view('area_distance.create', compact('areas'));
    }

    /**
     * Store a new distance manually or by auto-calculation.
     */
    public function store(Request $request)
    {
        $request->validate([
            'from_area_id' => 'required|exists:areas,id|different:to_area_id',
            'to_area_id'   => 'required|exists:areas,id|different:from_area_id',
            'auto'         => 'boolean', // If true, calculate automatically
            'distance_km'  => 'nullable|numeric|min:0',
        ]);

        $from = Area::findOrFail($request->from_area_id);
        $to   = Area::findOrFail($request->to_area_id);
        
        $distance = AreaDistance::create([
            'from_area_id' => $from->id,
            'to_area_id'   => $to->id,
            'distance_km'  => $distanceKm,
        ]);

        return redirect()->route('area_distances.index')->with('success', 'Distance created successfully');
    }

    /**
     * Display a specific distance record.
     */
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $distance = AreaDistance::findOrFail($id);
        $areas = Area::all();
        return view('area_distance.edit', compact('distance', 'areas'));
    }

    /**
     * Update an existing distance (manual edit).
     */
    public function update(Request $request, $id)
    {
        $distance = AreaDistance::findOrFail($id);

        $request->validate([
            'distance_km' => 'required|numeric|min:0',
        ]);

        $distance->update([
            'distance_km' => $request->distance_km,
        ]);

        return redirect()->route('area_distances.index')->with('success', 'Distance updated successfully');
    }

    /**
     * Delete a stored distance.
     */
    public function destroy($id)
    {
        $distance = AreaDistance::findOrFail($id);
        $distance->delete();

        return redirect()->route('area_distances.index')->with('success', 'Distance deleted successfully');
    }
}
