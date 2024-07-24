<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Avenue;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function Index()
    {
        $avenue = Avenue::with('owners','image')->get();
        return view('Frontend.Auth.index')->with('avenues',$avenue);
    }
}
