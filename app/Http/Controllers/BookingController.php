<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Service;
use App\Models\ServicePackage;
use App\Models\Customer;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display all bookings (admin only).
     */
    public function index()
    {
        $bookings = Booking::with(['customer', 'provider', 'service', 'package', 'details'])->get();
        return view('booking.index', compact('bookings'));
    }

    /**
     * Create a new booking (by customer).
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id'         => 'required|exists:customers,id',
            'service_id'          => 'required|exists:services,id',
            'service_package_id'  => 'required|exists:service_packages,id',
            'booking_date'        => 'required|date',
            'details'             => 'required|array',
        ]);

        // Create the main booking
        $booking = Booking::create([
            'customer_id'        => $request->customer_id,
            'service_id'         => $request->service_id,
            'service_package_id' => $request->service_package_id,
            'status'             => 'pending',
            'booking_date'       => $request->booking_date,
            'total_amount'       => 0, // will be updated after calculation
        ]);

        // Create booking details (based on service type)
        $details = $request->details;

        $detailData = [
            'booking_id'       => $booking->id,
            'area_sqft'        => $details['area_sqft'] ?? null,
            'hours'            => $details['hours'] ?? null,
            'distance_km'      => $details['distance_km'] ?? null,
            'pickup_area_id'   => $details['pickup_area_id'] ?? null,
            'delivery_area_id' => $details['delivery_area_id'] ?? null,
            'pickup_floor'     => $details['pickup_floor'] ?? null,
            'delivery_floor'   => $details['delivery_floor'] ?? null,
            'notes'            => $details['notes'] ?? null,
        ];

        $bookingDetail = BookingDetail::create($detailData);

        // Calculate billing based on service type
        $total = $this->calculateTotalAmount($booking, $bookingDetail);
        $booking->update(['total_amount' => $total]);

        return response()->json([
            'message' => 'Booking created successfully',
            'booking' => $booking->load('details', 'service', 'package')
        ], 201);
    }

    /**
     * Show a single booking.
     */
    public function show($id)
    {
        $booking = Booking::with(['customer', 'provider', 'service', 'package', 'details'])
            ->findOrFail($id);

        return response()->json($booking);
    }
    public function edit($id)
    {
        $booking = Booking::with(['customer', 'provider', 'service', 'package', 'details'])
            ->findOrFail($id);

        $customers = Customer::all();
        $services = Service::all();
        $packages = ServicePackage::all();
        $providers = ServiceProvider::all();

        return view('booking.edit', compact('booking', 'customers', 'services', 'packages', 'providers'));
    }


    /**
     * Assign provider (admin only).
     */
    public function assignProvider(Request $request, $id)
    {
        $request->validate([
            'provider_id' => 'required|exists:service_providers,id',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->provider_id = $request->provider_id;
        $booking->status = 'accepted';
        $booking->save();

        return response()->json(['message' => 'Provider assigned successfully', 'booking' => $booking]);
    }

    /**
     * Update booking details (by provider or admin).
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);


        $request->validate([
            'status' => 'nullable|in:pending,accepted,completed,cancelled',
            'details' => 'nullable|array',

        ]);


        if ($request->filled('status')) {
            $booking->status = $request->status;
        }


        if ($request->has('details')) {
            $details = $booking->details;
            $details->update($request->input('details'));

            // $booking->total_amount = $this->calculateTotalAmount($booking, $details);
        }




        $booking->save();


        
        return redirect()->route('booking.index')->with('success', 'Booking updated successfully');

    }

    /**
     * Delete a booking (admin only).
     */
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return response()->json(['message' => 'Booking deleted successfully']);
    }

    /**
     * Customer view: list their own bookings.
     */
    public function customerBookings($customerId)
    {
        $bookings = Booking::with(['service', 'package', 'details'])
            ->where('customer_id', $customerId)
            ->get();

      return redirect()->route('booking.index')->with('success', 'Booking updated successfully');
    }

    /**
     * Provider view: list assigned bookings.
     */
    public function providerBookings($providerId)
    {
        $bookings = Booking::with(['customer', 'service', 'package', 'details'])
            ->where('provider_id', $providerId)
            ->get();

        return response()->json($bookings);
    }

    /**
     * Billing calculation logic based on service type.
     */
    private function calculateTotalAmount(Booking $booking, BookingDetail $detail)
    {
        $service = $booking->service;
        $package = $booking->package;
        $total = $package->base_price ?? 0;

        switch ($service->billing_type) {
            case 'area': // Cleaning, Painting
                if ($detail->area_sqft && $package->unit_price) {
                    $total += $detail->area_sqft * $package->unit_price;
                }
                break;

            case 'hour': // Plumbing, Electrician, Carpenter
                if ($detail->hours && $package->unit_price) {
                    $total += $detail->hours * $package->unit_price;
                }
                break;

            case 'distance': // Furniture shifting
                if ($detail->distance_km && $package->unit_price) {
                    $total += $detail->distance_km * $package->unit_price;
                }
                break;
        }

        return $total;
    }
}
