<?php

namespace App\Http\Controllers;

use App\Models\Avenue;
use App\Models\Booking;
use App\Models\Owner;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function dashboard()
    {
        $bookings=Booking::count();
        $owners=Owner::count();
        $avenues=Avenue::count();
        return view('Backend.dashboard',compact('bookings','owners','avenues'));

    }

    
}
