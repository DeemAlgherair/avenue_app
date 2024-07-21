<?php

namespace App\Http\Controllers;

use App\Models\reviews;
use App\Http\Requests\StorereviewsRequest;
use App\Http\Requests\UpdatereviewsRequest;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StorereviewsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(reviews $reviews)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(reviews $reviews)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatereviewsRequest $request, reviews $reviews)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(reviews $reviews)
    {
        //
    }
}
