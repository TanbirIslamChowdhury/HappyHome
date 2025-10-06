<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingDetailController extends Controller
{
    /**
     * Display booking detail by ID.
     */
    public function show($id)
    {
        $booking = Booking::with([
            'customer',
            'servicePackage.service',
            'serviceProvider',
        ])->findOrFail($id);

        // Prepare a detailed response
        $detail = [
            'booking_id'        => $booking->id,
            'customer'          => $booking->customer,
            'service'           => $booking->servicePackage->service,
            'package'           => $booking->servicePackage,
            'assigned_provider' => $booking->serviceProvider,
            'service_params'    => $booking->service_params,
            'scheduled_at'      => $booking->scheduled_at,
            'status'            => $booking->status,
            'price'             => $booking->price,
            'additional_notes'  => $booking->additional_notes,
        ];

        return response()->json($detail);
    }

    /**
     * Display all booking details for a specific customer.
     */
    public function customerBookings($customer_id)
    {
        $bookings = Booking::with([
            'servicePackage.service',
            'serviceProvider',
        ])->where('customer_id', $customer_id)->latest()->get();

        return response()->json($bookings);
    }

    /**
     * Display all booking details for a specific service provider.
     */
    public function providerBookings($provider_id)
    {
        $bookings = Booking::with([
            'customer',
            'servicePackage.service',
        ])->where('service_provider_id', $provider_id)->latest()->get();

        return response()->json($bookings);
    }
}
