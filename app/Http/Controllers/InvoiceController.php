<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Http\Requests\StoreAvenuebinvoiceRequest;
use App\Http\Requests\UpdateAvenuebinvoiceRequest;
use App\Models\Booking;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoice =Invoice::with(['bookings','invoice_statuses'])->get();
        
        return view('Backend.booking.show-booking')->with('$invoice',$invoice);
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
    public function store(StoreAvenuebinvoiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
 // InvoiceController.php

public function show($id)
{
    
    $booking = Booking::with('status')->findOrFail($id);
   
    return view('frontend.layout.invoice', compact('booking'));
}


    
   
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $avenuebinvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAvenuebinvoiceRequest $request, Invoice $avenuebinvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $avenuebinvoice)
    {
        //
    }
}
