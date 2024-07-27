<?php

namespace App\Http\Controllers;
use  App\Models\Booking;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function showPaymentForm(Booking $booking)
    {
        
        if ($booking->customer_id !== Auth::id()) {
            return redirect()->route('home')->withErrors('Unauthorized access.');
        }

        return view('frontend.layout.payment', compact('booking'));
    }

    // Process the payment
    public function processPayment(Request $request, Booking $booking)
    {
        
        if ($booking->customer_id !== Auth::id()) {
            return redirect()->route('home')->withErrors('Unauthorized access.');
        }

    
        $request->validate([
            'card_number' => 'required|digits:16',
            'card_expiry' => 'required|size:5',
            'card_cvc' => 'required|digits:3',
        ]);

       
        $booking->status_id = 2; 
        $booking->save();

        
        return redirect()->route('home', ['id' => $booking->id])->with('success', 'Payment successful!');
    }
}
