<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Avenue;
use App\Models\Avenue_Image;
use Illuminate\Http\Request;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function all()
    {
        $avenues = Avenue::with('owners', 'reviews')->get()->map(function($avenue) {
            $averageRating = $avenue->reviews->avg('rate'); 
            $avenue->averageRating = $averageRating;
            return $avenue;
        });
        $images = Avenue_Image::all();
    
        return view('Frontend.layout.allAvenue', ['avenues' => $avenues],['images' => $images]);
    }

    public function filter(Request $request)
    {
        // Start with a base query
        $query = Avenue::query();
        
        // Filter by location (multiple values)
        $locations = $request->input('location', []);
        $sizes = $request->input('size', []);
        if (!empty($locations)) {
            $query->whereIn('location', $locations);
        }
        
        // Filter by size (multiple values)
        $sizes = $request->input('size', []);
        if (!empty($sizes)) {
            $query->where(function($q) use ($sizes) {
                foreach ($sizes as $size) {
                    $sizeRange = explode('-', $size);
                    if (count($sizeRange) == 2) {
                        $q->orWhereBetween('size', [(int)$sizeRange[0], (int)$sizeRange[1]]);
                    } elseif (count($sizeRange) == 1) {
                        // Handle case for "100+" size
                        $q->orWhere('size', '>=', (int)$sizeRange[0]);
                    }
                }
            });
        }
        
        // Filter by price
        $price = $request->input('price', '');
        if ($price != '') {
            $query->where('price_per_hours', '<=', $price);
        }
        
        $avenues = $query->with('owners', 'reviews')->get();
        
        $avenues->map(function($avenue) {
            $averageRating = $avenue->reviews->avg('rate'); 
            $avenue->averageRating = $averageRating;
            return $avenue;
        });
        
        $images = Avenue_Image::whereIn('avenue_id', $avenues->pluck('id'))->get();
        
        return view('frontend.layout.allAvenue', [
            'avenues' => $avenues,
            'images' => $images,
            'selectedLocations' => $locations,
            'selectedSizes' => $sizes,
            'selectedPrice' => $price,
        ]);
    }
    
    
    
}
