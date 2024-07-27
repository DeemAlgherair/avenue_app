<?php

namespace App\Http\Controllers;

use App\Models\Avenue;
use App\Models\Day;
use App\Models\Review;
use App\Models\Booking;
use App\Http\Requests\StoreAvenuebookingRequest;
use App\Http\Requests\UpdateAvenuebookingRequest;
use Illuminate\Http\Request;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with(['customers','avenues','booking_statuses'])->get();
        
        return view('Backend.booking.show-booking')->with('bookings',$bookings);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($avenueId)
    {
        
    }
    function generateUniqueSerialNumber()
    {
        // Get the current timestamp (you can adjust this format as needed)
        $timestamp = now()->format('YmdHis');
    
        // Generate a random string (e.g., 6 characters)
        $randomString = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);
    
        // Combine timestamp and random string
        $serialNumber = $timestamp . $randomString;
    
        return $serialNumber;
    }
    /**
     * Store a newly created resource in storage.
     */
    
     public function store(StoreAvenuebookingRequest $request, $avenueId)
     {
         $selectedAvenue = Avenue::find($avenueId);
     
         // Validate form data
         $validatedData = $request->validated();
         $customer_id = $request->user() ? $request->user()->id : null;
         $booking = new Booking();
         $booking->serial_no = $this->generateUniqueSerialNumber();
         $booking->booking_date = now();
         $booking->customer_id = $customer_id;
         $booking->avenue_id = $selectedAvenue->id;
         $booking->status_id = 1; // 'Pending'
         $booking->subtotal = $validatedData['size'] * $selectedAvenue->price_per_hours;
         $booking->tax = 0;
         $booking->total = $booking->subtotal + $booking->tax;
         $booking->save();
         return redirect()->route('invoice.show', $booking->id)
         ->with('success', 'Booking created successfully!');
         
     }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,$avenueId)
    {   $selectedAvenue = Avenue::find($avenueId); // Assuming you have an 'Avenue' model
        $availableDays = Day::all(); // Assuming you have a 'Day' model
    
        return view("Frontend.layout.booking", [
            'selectedAvenue' => $selectedAvenue,
            'availableDays' => $availableDays
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function detailsBooking($id)
    {
       $bookings = Booking::findOrFail($id);
      return view('Backend.booking.details-booking')->with('bookings',$bookings);
    }
    public function printinvoice($id)
    {
        
       $bookings = Booking::findOrFail($id);
      return view('Backend.booking.print-invoice')->with('bookings',$bookings);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAvenuebookingRequest $request, Booking $avenuebooking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bookings= Booking::findOrFail($id);
        $bookings->delete();
        session()->flash('success', 'Reservation deleted successfully!');
        return redirect()->route('showReservation');
    }

    public function showConfirmedBookings()
    {
        // Fetch all confirmed bookings
        $confirmedBookings = Booking::whereHas('status', function($query) {
            $query->where('statues_name', 'confirmed');
        })->get();

        return view('Frontend.layout.Confirmed', compact('confirmedBookings'));
    }

    public function reviewBooking($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
    
        // Fetch the existing review if it exists
        $review = Review::where('user_id', auth()->id())
                        ->where('avenue_id', $booking->avenue_id)
                        ->where('booking_id', $bookingId)
                        ->first();
    
        return view('Frontend.layout.review', [
            'booking' => $booking,
            'review' => $review // Pass the review to the view
        ]);
    }
    

   public function submitReview(Request $request, $bookingId)
{
    $request->validate([
        'rate' => 'required|integer|min:1|max:5',
        'comment' => 'required|string',
    ]);

    $booking = Booking::findOrFail($bookingId);

    // Check if a review already exists
    $review = Review::where('user_id', auth()->id())
                    ->where('avenue_id', $booking->avenue_id)
                    ->where('booking_id', $bookingId)
                    ->first();

    if ($review) {
        // Update the existing review
        $review->update([
            'rate' => $request->input('rate'),
            'comment' => $request->input('comment'),
        ]);
    } else {
        // Create a new review
        Review::create([
            'rate' => $request->input('rate'),
            'comment' => $request->input('comment'),
            'user_id' => auth()->id(),
            'avenue_id' => $booking->avenue_id,
            'booking_id' => $bookingId // Ensure booking_id is provided here
        ]);
    }

    return redirect()->route('confirmed.bookings')
                     ->with('success', 'Review submitted successfully!');
}

    
}
