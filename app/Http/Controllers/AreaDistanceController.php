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
        return response()->json($distances);
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

        // Check if already exists
        $existing = AreaDistance::where('from_area_id', $from->id)
            ->where('to_area_id', $to->id)
            ->first();

        if ($existing) {
            return response()->json([
                'message'  => 'Distance already exists',
                'distance' => $existing,
            ]);
        }

        // Auto calculate if requested or no manual input
        $distanceKm = $request->auto || !$request->distance_km
            ? $this->calculateDistanceInKm($from->latitude, $from->longitude, $to->latitude, $to->longitude)
            : $request->distance_km;

        $distance = AreaDistance::create([
            'from_area_id' => $from->id,
            'to_area_id'   => $to->id,
            'distance_km'  => $distanceKm,
        ]);

        return response()->json([
            'message'  => 'Distance created successfully',
            'distance' => $distance,
        ], 201);
    }

    /**
     * Display a specific distance record.
     */
    public function show($id)
    {
        $distance = AreaDistance::with(['fromArea', 'toArea'])->findOrFail($id);
        return response()->json($distance);
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

        return response()->json([
            'message'  => 'Distance updated successfully',
            'distance' => $distance,
        ]);
    }

    /**
     * Delete a stored distance.
     */
    public function destroy($id)
    {
        $distance = AreaDistance::findOrFail($id);
        $distance->delete();

        return response()->json(['message' => 'Distance deleted successfully']);
    }

    /**
     * Recalculate and update the distance (using Google Maps or fallback).
     */
    public function recalculate($id)
    {
        $distance = AreaDistance::findOrFail($id);
        $from = $distance->fromArea;
        $to = $distance->toArea;

        $newDistance = $this->calculateDistanceInKm($from->latitude, $from->longitude, $to->latitude, $to->longitude);

        $distance->update(['distance_km' => $newDistance]);

        return response()->json([
            'message'  => 'Distance recalculated successfully',
            'distance' => $distance,
        ]);
    }

    /**
     * Utility: Calculate distance (Google Maps or fallback Haversine formula).
     */
    private function calculateDistanceInKm($lat1, $lon1, $lat2, $lon2)
    {
        $apiKey = env('GOOGLE_MAPS_API_KEY');

        if ($apiKey) {
            $url = "https://maps.googleapis.com/maps/api/distancematrix/json";
            $response = Http::get($url, [
                'origins'      => "$lat1,$lon1",
                'destinations' => "$lat2,$lon2",
                'key'          => $apiKey,
            ]);

            if ($response->successful() && isset($response['rows'][0]['elements'][0]['distance']['value'])) {
                return round($response['rows'][0]['elements'][0]['distance']['value'] / 1000, 2);
            }
        }

        // Fallback: Haversine formula
        $earthRadius = 6371; // km
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) ** 2 + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) ** 2;
        $c = 2 * asin(sqrt($a));
        return round($earthRadius * $c, 2);
    }
}
