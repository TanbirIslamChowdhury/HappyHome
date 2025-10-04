<?php

namespace App\Http\Controllers;

use App\Models\ServiceProvider;
use App\Models\Feedback;
use Illuminate\Http\Request;

class ProviderRatingController extends Controller
{
    /**
     * Display overall rating for a specific provider.
     */
    public function show($provider_id)
    {
        $provider = ServiceProvider::findOrFail($provider_id);

        $feedbacks = Feedback::where('service_provider_id', $provider_id)->latest()->get();

        $averageRating = round($feedbacks->avg('rating'), 2);
        $totalReviews  = $feedbacks->count();

        return response()->json([
            'provider'        => $provider,
            'average_rating'  => $averageRating,
            'total_reviews'   => $totalReviews,
            'feedbacks'       => $feedbacks,
        ]);
    }

    /**
     * Display feedback list for a specific provider with pagination.
     */
    public function feedbacks(Request $request, $provider_id)
    {
        $perPage = $request->query('per_page', 10);

        $feedbacks = Feedback::where('service_provider_id', $provider_id)
            ->with('customer', 'booking')
            ->latest()
            ->paginate($perPage);

        return response()->json($feedbacks);
    }

    /**
     * List top-rated providers.
     */
    public function topRated(Request $request)
    {
        $limit = $request->query('limit', 10);

        $providers = ServiceProvider::with('feedbacks')
            ->get()
            ->map(function ($provider) {
                $provider->average_rating = round($provider->feedbacks->avg('rating'), 2);
                $provider->total_reviews  = $provider->feedbacks->count();
                return $provider;
            })
            ->sortByDesc('average_rating')
            ->take($limit)
            ->values();

        return response()->json($providers);
    }
}
