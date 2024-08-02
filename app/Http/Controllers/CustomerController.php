<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Avenue;
use App\Models\Avenue_Image;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function all()
    {
        $avenues = Avenue::with('owners', 'reviews')->get()->map(function($avenue) {
            $averageRating = $avenue->reviews->avg('rate'); 
            $avenue->averageRating = $averageRating;
            return $avenue;
        });
        $images = Avenue_Image::all();
    
        return view('Frontend.layout.allAvenue', ['avenues' => $avenues],['images' => $images]);
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
    public function store(StoreCustomerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
