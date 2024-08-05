<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function showPaymentForm($bookingId)
    {
        // Find the booking or fail with a 404 error if not found
        $booking = Booking::findOrFail($bookingId);

        $pay = Booking::where('customer_id', auth()->id())
            ->where('avenue_id', $booking->avenue_id)
            ->where('id', $bookingId)
            ->first();

        return view('Frontend.layout.payment', [
            'booking' => $booking,
            'pay' => $pay
        ]);
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

    public function callback(Booking $booking)
    {
        $id = request()->query('id');
        $token = base64_encode(config('services.moyasar.secret') . ':');

        $payment = Http::withOptions([
            'verify' => false, // Disable SSL verification (not recommended for production)
        ])
        ->baseUrl('https://api.moyasar.com/v1')
        ->withBasicAuth(config('services.moyasar.secret'), '')
        ->get("payments/{$id}")
        ->json();

        // Check if the 'status' key exists before accessing it
        if (isset($payment['type']) && $payment['type'] == 'invalid_request_error') {
            return redirect()->route('payment.show', [$booking->id])->with('error', $payment['message'] ?? 'Invalid request error');
        }

        if (isset($payment['status']) && $payment['status'] == 'paid') {
            $booking->status_id = 3; // paid
            $booking->save();

            // You do not need to capture a payment that is already paid
            return redirect()->route('payment.show', [$booking->id])->with('success', 'Order paid!');
        }

        // If payment is authorized but not paid, attempt to capture it
        if (isset($payment['status']) && $payment['status'] == 'authorized') {
            $capture = Http::withOptions([
                'verify' => false, // Disable SSL verification (not recommended for production)
            ])
            ->baseUrl('https://api.moyasar.com/v1')
            ->withHeaders(['Authorization' => "Basic {$token}"])
            ->post("payments/{$id}/capture")
            ->json();

            if (isset($capture['type']) && $capture['type'] == 'invalid_request_error') {
                return redirect()->route('payment.show', [$booking->id])->with('error', $capture['message'] ?? 'Invalid request error');
            }

            if (isset($capture['status']) && $capture['status'] == 'captured') {
                $booking->status_id = 3; // paid
                $booking->save();

                return redirect()->route('invoice.show', [$booking->id])->with('success', 'Payment is successful');
            }
        }

        return redirect()->route('payment.show', [$booking->id])->with('error', 'Payment not successful');
    }
}
