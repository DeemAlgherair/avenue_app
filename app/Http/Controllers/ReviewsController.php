<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Avenue;
use App\Models\Advantage;

use App\Models\Avenue_Image;

use Illuminate\Http\Request;

use App\Http\Requests\StorereviewsRequest;
use App\Http\Requests\UpdatereviewsRequest;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     //
    
     public function sortReviews(Request $request, $id)
     {   
         $avenue = Avenue::with('reviews')->findOrFail($id);
        
        // Sorting
        $sort = request('sort', 'latest');
        $reviewsQuery = $avenue->reviews();
        
        switch ($sort) {
            case 'highest':
                $reviewsQuery->orderBy('rate', 'desc');
                break;
            case 'lowest':
                $reviewsQuery->orderBy('rate', 'asc');
                break;
            case 'latest':
            default:
                $reviewsQuery->orderBy('created_at', 'desc');
                break;
        }
        
        $reviews = $reviewsQuery->get();
        $sortValue = $request->input('sort', 'latest');
        
        // Calculations
        $totalReviews = $reviews->count();
        $averageRating = $reviews->avg('rate');
        $reviewCounts = [
            5 => $reviews->where('rate', 5)->count(),
            4 => $reviews->where('rate', 4)->count(),
            3 => $reviews->where('rate', 3)->count(),
            2 => $reviews->where('rate', 2)->count(),
            1 => $reviews->where('rate', 1)->count(),
        ];
        
        // Other Data
        $Avenueadvantages = Advantage::all();
        $images = Avenue_Image::where('avenue_id', $id)->get();
        
        
        return view('Frontend.layout.sort-review')
            ->with('avenue', $avenue)
            ->with('images', $images)
            ->with('reviews', $reviews) // Pass sorted reviews to view
            ->with('reviewCounts', $reviewCounts)
            ->with('totalReviews', $totalReviews)
            ->with('Avenueadvantages', $Avenueadvantages)
            ->with('sortValue', $sortValue)
            ->with('averageRating', $averageRating);
}


// Helper methods
protected function getSortColumn($sortValue)
{
    switch ($sortValue) {
        case 'highest':
            return 'rate';
        case 'lowest':
            return 'rate';
        default:
            return 'rate';
    }
}

protected function getSortDirection($sortValue)
{
    switch ($sortValue) {
        case 'highest':
            return 'desc';
        case 'lowest':
            return 'asc';
        default:
            return 'desc';
    }
}

     
     
}