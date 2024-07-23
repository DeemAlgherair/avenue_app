<?php

namespace App\Http\Controllers;

use App\Models\Avenue;
use App\Models\Customer;
use App\Models\Booking;
use App\Http\Requests\StoreAvenuebookingRequest;
use App\Http\Requests\UpdateAvenuebookingRequest;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with(['customers','avenues','status'])->get();
        
        return view('Backend.booking.show-booking')->with('bookings',$bookings);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAvenuebookingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $avenuebooking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $bookings =  Booking::findOrFail($id);
        return view('Backend.booking.edit-booking')->with('bookings',$bookings);
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
}
