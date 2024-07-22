<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Avenue;
use App\Http\Requests\StoreOwnerRequest;
use App\Http\Requests\UpdateOwnerRequest;

class OwnerController extends Controller
{
    public function index()
    {
        $owners = Owner::with('avenues')->get();
        
        return view('Backend.Owner.show-owner')->with('owners',$owners);
    }

    public function create()
    {
        $avenues = Avenue::where('owener_id')->get();
        return view ('Backend.Owner.create-owner')->with('avenues',$avenues);
    }
    
    public function store(StoreOwnerRequest $request)
    {
        $request->validated();  
        
        $owner = Owner::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        
        if ($request->has('avenue_ids')) {
            $avenueIds = $request->input('avenue_ids');
            Avenue::whereIn('id', $avenueIds)->update(['owener_id' => $owner->id]);
        }
    
        session()->flash('success', 'Owner created successfully!');
        return redirect()->route('showOwner'); 
    }    public function edit($id)
    {
        $owner = Owner::findOrFail($id);
        $avenues = Avenue::where('owener_id')->get();
        return view('Backend.Owner.edit-owner')->with('owner',$owner)
        ->with('avenues',$avenues);
    }

  
    public function update(UpdateOwnerRequest $request, $id)
    {
        // Validate the request
        $request->validated();
        
        // Find the owner
        $owner = Owner::findOrFail($id);
        
        // Update the owner's information
        $owner->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        
        if ($request->has('add_avenue_ids')) {
            $avenueIdsToAdd = $request->input('add_avenue_ids');
            Avenue::whereIn('id', $avenueIdsToAdd)->update(['owener_id' => $owner->id]);
        }
    
        if ($request->has('remove_avenue_ids')) {
            $avenueIdsToRemove = $request->input('remove_avenue_ids');
            Avenue::whereIn('id', $avenueIdsToRemove)->update(['owener_id' => null]);
        }
        
        // Flash a success message and redirect
        session()->flash('success', 'Owner updated successfully!');
        return redirect()->route('showOwner');
    }
    

   
    public function destroy($id)
    {
        $owners= Owner::findOrFail($id);
        $owners->delete();
        session()->flash('success', 'Owner deleted successfully!');
        return redirect()->route('showOwner');
    }
}
