<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Http\Requests\StoreOwnerRequest;
use App\Http\Requests\UpdateOwnerRequest;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $owners = Owner::all();
        return view('Backend.Owner.show-owner')->with('owners',$owners);
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
    public function store(StoreOwnerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Owner $owner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $owner = Owner::findOrFail($id);
        return view('Backend.Owner.edit-owner')->with('owner',$owner);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOwnerRequest $request, )
    {
        
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $owners= Owner::findOrFail($id);
        $owners->delete();
    
        // Add a session flash message
        session()->flash('success', 'Owner deleted successfully!');
    
        return redirect()->route('showOwner');
    }
}
