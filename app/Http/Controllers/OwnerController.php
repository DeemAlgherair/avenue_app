<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Avenue;
use App\Models\Day;
use App\Models\Avenue_Day;
use Illuminate\Http\Request; 

use App\Http\Requests\StoreOwnerRequest;
use App\Http\Requests\UpdateOwnerRequest;
use Illuminate\Support\Facades\Hash;


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
        
            $validated = $request->validated();
            if (Owner::where('email', $validated['email'])->exists()) {
                toastr()->error('The email has already been taken.');
                return back();
            }
            if (Owner::where('phone', $validated['phone'])->exists()) {
                toastr()->error('Phone number has already been taken.');
                return back();

            }
            $owner = Owner::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'last_login'=>now()
            ]);
          
        
           
            $days = Day::all();
            $status = Avenue_Day::with(['status'])->get();
            return view ('Backend.Avenue.create-avenue')->with('owner_id',$owner->id)
            ->with('days',$days)->with('status',$status);
        
        
    } 
    

    public function edit($id)
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
        
        $owner = Owner::findOrFail($id);
        $avenue = Avenue::where('owener_id', $id)->firstOrFail();
        $owner->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        
        if ($request->has('add')) {
            return redirect()->route('createAvenue', $owner->id);
        }

        if ($request->has('update_avenue')) {
            return redirect()->route('updateAvenue', $avenue->id);
        }
    
        session()->flash('success', 'Owner updated successfully!');
        return back();
    }
    

   
    public function destroy($id)
    {
        $owners= Owner::findOrFail($id);
        $owners->delete();
        session()->flash('success', 'Owner deleted successfully!');
        return redirect()->route('showOwner');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
    
        $owners = owner::where('name', 'LIKE', '%' . $query . '%')->get();
    
        // تمرير النتائج إلى العرض
        return view('Backend.Owner.search', compact('owners'));
    }
    
}
