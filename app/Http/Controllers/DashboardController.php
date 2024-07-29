<?php

namespace App\Http\Controllers;

use App\Models\Avenue;
use App\Models\Booking;
use App\Models\Owner;
use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    
    public function dashboard()
    {
       
        $bookings = Booking::count();
        $owners = Owner::count();
        $avenues = Avenue::count();
        $customers= Customer::count();
        $topAvenues = Avenue::withCount('bookings')
                            ->orderBy('bookings_count', 'desc')
                            ->take(5)
                            ->get();
        $data = [
                                'labels' => ['Owners', 'Avenues', 'Reseravtions','Customers'],
                                'data' => [$owners , $avenues, $bookings,$customers],
                            ];
     
        return view('Backend.dashboard', compact('bookings', 'owners', 'avenues', 'topAvenues','data'));}

    
}
