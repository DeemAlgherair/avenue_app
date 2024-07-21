<?php

namespace App\Http\Controllers;

use App\Models\image;
use App\Http\Requests\StoreimageRequest;
use App\Http\Requests\UpdateimageRequest;

class ImageController extends Controller
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
    public function store(StoreimageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateimageRequest $request, image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(image $image)
    {
        //
    }
}
