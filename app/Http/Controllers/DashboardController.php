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
        // Get counts for the dashboard summary
        $bookings = Booking::count();
        $owners = Owner::count();
        $avenues = Avenue::count();
        $customers = Customer::count();

        // Prepare data for Reservations Over Time chart
        $reservationsData = Booking::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Prepare data for Reviews Over Avenue chart
        $reviewsData = Avenue::withCount('reviews') // Assuming you have a `reviews` relationship on Avenue
            ->get()
            ->map(function ($avenue) {
                return [
                    'label' => $avenue->name, // Assuming Avenue model has a `name` attribute
                    'count' => $avenue->reviews_count
                ];
            });

        $data = [
            'labels' => ['Avenues', 'Reservations', 'Customers'],
            'data' => [$avenues, $bookings, $customers],
        ];

        return view('Backend.dashboard', compact('bookings', 'owners', 'avenues', 'customers', 'data', 'reservationsData', 'reviewsData'));
    }
}
