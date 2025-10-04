<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Booking;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display all feedbacks (Admin or for reports).
     */
    public function index()
    {
        $feedbacks = Feedback::with(['customer', 'serviceProvider', 'booking'])->latest()->get();
        return response()->json($feedbacks);
    }

    /**
     * Store new feedback (by Customer after service completion).
     */
    public function store(Request $request)
    {
        $request->validate([
            'booking_id'         => 'required|exists:bookings,id',
            'service_provider_id'=> 'required|exists:service_providers,id',
            'customer_id'        => 'required|exists:customers,id',
            'rating'             => 'required|integer|min:1|max:5',
            'comment'            => 'nullable|string|max:500',
        ]);

        $booking = Booking::findOrFail($request->booking_id);

        if ($booking->status !== 'completed') {
            return response()->json(['message' => 'You can only give feedback after service completion'], 403);
        }

        // Prevent duplicate feedback
        $existing = Feedback::where('booking_id', $request->booking_id)
            ->where('customer_id', $request->customer_id)
            ->first();

        if ($existing) {
            return response()->json(['message' => 'Feedback already submitted for this booking'], 409);
        }

        $feedback = Feedback::create([
            'booking_id'          => $request->booking_id,
            'service_provider_id' => $request->service_provider_id,
            'customer_id'         => $request->customer_id,
            'rating'              => $request->rating,
            'comment'             => $request->comment,
        ]);

        // Update provider’s average rating
        $avgRating = Feedback::where('service_provider_id', $request->service_provider_id)->avg('rating');
        $provider = ServiceProvider::find($request->service_provider_id);
        $provider->average_rating = round($avgRating, 2);
        $provider->save();

        return response()->json([
            'message'  => 'Feedback submitted successfully',
            'feedback' => $feedback
        ], 201);
    }

    /**
     * Show single feedback.
     */
    public function show($id)
    {
        $feedback = Feedback::with(['customer', 'serviceProvider', 'booking'])->findOrFail($id);
        return response()->json($feedback);
    }

    /**
     * Update feedback (optional - only by customer).
     */
    public function update(Request $request, $id)
    {
        $feedback = Feedback::findOrFail($id);

        $request->validate([
            'rating'  => 'sometimes|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $feedback->update($request->only(['rating', 'comment']));

        // Recalculate provider’s rating
        $avgRating = Feedback::where('service_provider_id', $feedback->service_provider_id)->avg('rating');
        $provider = ServiceProvider::find($feedback->service_provider_id);
        $provider->average_rating = round($avgRating, 2);
        $provider->save();

        return response()->json([
            'message'  => 'Feedback updated successfully',
            'feedback' => $feedback
        ]);
    }

    /**
     * Delete feedback (Admin or customer).
     */
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        // Update provider rating
        $avgRating = Feedback::where('service_provider_id', $feedback->service_provider_id)->avg('rating');
        $provider = ServiceProvider::find($feedback->service_provider_id);
        $provider->average_rating = round($avgRating, 2);
        $provider->save();

        return response()->json(['message' => 'Feedback deleted successfully']);
    }
}
