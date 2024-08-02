<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Avenue;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function index()
    {
        $avenues = Avenue::with('owners', 'reviews')->get()->map(function($avenue) {
            $averageRating = $avenue->reviews->avg('rate'); 
            $avenue->averageRating = $averageRating;
            return $avenue;
        });
        
        return view('Frontend.Auth.index', ['avenues' => $avenues]);
    }
}
