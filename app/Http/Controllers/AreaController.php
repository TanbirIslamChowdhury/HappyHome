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
        return response()->json($areas);
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

        return response()->json([
            'message' => 'Area created successfully',
            'area'    => $area,
        ], 201);
    }

    /**
     * Display a specific area.
     */
    public function show($id)
    {
        $area = Area::findOrFail($id);
        return response()->json($area);
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

        return response()->json([
            'message' => 'Area updated successfully',
            'area'    => $area,
        ]);
    }

    /**
     * Delete an area.
     */
    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        $area->delete();

        return response()->json(['message' => 'Area deleted successfully']);
    }

    /**
     * Toggle area active/inactive status.
     */
    public function toggleStatus($id)
    {
        $area = Area::findOrFail($id);
        $area->is_active = !$area->is_active;
        $area->save();

        return response()->json([
            'message' => 'Area status updated successfully',
            'area'    => $area,
        ]);
    }

    /**
     * Calculate and store the distance between two areas.
     * Optionally uses Google Maps Distance Matrix API.
     */
    public function calculateDistance(Request $request)
    {
        $request->validate([
            'from_area_id' => 'required|exists:areas,id',
            'to_area_id'   => 'required|exists:areas,id',
        ]);

        $from = Area::findOrFail($request->from_area_id);
        $to   = Area::findOrFail($request->to_area_id);

        // Check if already stored in DB
        $existing = AreaDistance::where('from_area_id', $from->id)
            ->where('to_area_id', $to->id)
            ->first();

        if ($existing) {
            return response()->json([
                'message'  => 'Distance fetched from database cache',
                'distance' => $existing->distance_km,
            ]);
        }

        $distanceKm = $this->calculateDistanceInKm($from->latitude, $from->longitude, $to->latitude, $to->longitude);

        // Save it to DB for next time
        AreaDistance::create([
            'from_area_id' => $from->id,
            'to_area_id'   => $to->id,
            'distance_km'  => $distanceKm,
        ]);

        return response()->json([
            'message'  => 'Distance calculated successfully',
            'distance' => $distanceKm,
        ]);
    }

    /**
     * Utility: Calculate distance (fallback or Google Maps if configured).
     */
    private function calculateDistanceInKm($lat1, $lon1, $lat2, $lon2)
    {
        // 🔹 If you have a Google Maps API key in .env:
        // GOOGLE_MAPS_API_KEY=your_key_here
        $apiKey = env('GOOGLE_MAPS_API_KEY');

        if ($apiKey) {
            $url = "https://maps.googleapis.com/maps/api/distancematrix/json";
            $response = Http::get($url, [
                'origins'      => "$lat1,$lon1",
                'destinations' => "$lat2,$lon2",
                'key'          => $apiKey,
            ]);

            if ($response->successful() && isset($response['rows'][0]['elements'][0]['distance']['value'])) {
                // Google returns meters
                return round($response['rows'][0]['elements'][0]['distance']['value'] / 1000, 2);
            }
        }

        // 🔹 Fallback: Haversine formula (no API cost)
        $earthRadius = 6371; // in km
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) ** 2 + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon / 2) ** 2;
        $c = 2 * asin(sqrt($a));
        return round($earthRadius * $c, 2);
    }
}
