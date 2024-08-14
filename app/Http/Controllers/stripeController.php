<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Stripe\StripeClient;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class stripeController extends Controller
{
    protected $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('services.stripe.secret'));
    }public function pay(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
    
        // Ensure the booking belongs to the authenticated user
        if ($booking->customer_id !== Auth::id()) {
            return redirect()->route('home')->withErrors('Unauthorized access.');
        }
    
        $session = $this->stripe->checkout->sessions->create([
            'payment_method_types' => ['card', 'link'], // Add other payment methods if needed
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Booking - ' . $booking->serial_no,
                        ],
                        'unit_amount' => $booking->total * 100, // amount in cents
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('payment.success', ['bookingId' => $booking->id]),
            'cancel_url' => route('payment.cancel'),
        ]);
    
        return redirect($session->url);
    }
    
    
    public function success(Request $request, $bookingId)
    {
        // Find the booking to display in the success view
        $booking = Booking::findOrFail($bookingId);

        // Directly update booking status to 'paid' (3) since payment is successful
        $booking->status_id = 3; // Mark as paid
        $booking->save();

        return view('Frontend.layout.paymentsuccess', compact('booking'));
    }

    public function cancel()
    {
        return view('Frontend.layout.failed');
    }
}

   

