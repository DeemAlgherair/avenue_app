<?php

namespace App\Http\Controllers;

use App\Models\Avenue;
use App\Models\Avenue_Day;
use App\Models\Day;
use App\Models\Owner;
use App\Models\Review;

use App\Models\Avenue_Image;
use App\Models\Image;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAvenueRequest;
use App\Http\Requests\UpdateAvenueRequest;
class AvenueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $avenues = Avenue::with(['owner','days'])->get();
      
        return view ('Backend.Avenue.show-avenue')->with('avenues',$avenues);
    }

    /**
     * Show the form for creating a new resource.
     */

     function generateUniqueSerialNumber()
    {
        // Get the current timestamp
        $timestamp = now()->format('YmdHis');
    
        // Generate a random string 
        $randomString = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);
    
        // Combine timestamp and random string
        $serialNumber = $timestamp . $randomString;
    
        return $serialNumber;
    }
    public function create($owner_id)
    {
        $days = Day::all();
        $status = Avenue_Day::with(['status'])->get();
        return view ('Backend.Avenue.create-avenue')->with('days',$days)->with('status',$status)
        ->with('owner_id', $owner_id );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAvenueRequest $request,$owner_id)
    {
    $request->validated();

    //
    $path= $request->file('image')->store('avenues','public');
    $image = Image::insertGetId(['url' => $path]);
    $avenue = Avenue::create([
        'name' => $request->name,
        'location' => $request->location,
        'price_per_hours' => $request->price,
        'size' => $request->size,
        'advantages' => $request->advantages,
        'image_id' => $image,
        'serial_no' => $this->generateUniqueSerialNumber(), 
        'owener_id' =>$owner_id
    ]);


    if ($request->has('days')) {
        $avenue->days()->sync($request->input('days'));
    } else {
        $avenue->days()->sync([]); 
    }

  

    session()->flash('success', 'Avenue created successfully!');
    return redirect()->route('showAvenue');
}


    /**
     * Display the specified resource.
     */
    public function show( $id){
         $avenue = Avenue::with('reviews')->findOrFail($id);
         $reviews = $avenue->reviews;
         $averageRating = $reviews->avg('rate'); 
         return view('Frontend.layout.view')->with('avenue', $avenue)->with('averageRating',$averageRating);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $avenues = Avenue::with(['owner', 'days','image'])->findOrFail($id);
        $alldays = Day::all();
        $selectedDays = $avenues->days->pluck('id')->toArray();
        return view ('Backend.Avenue.edit-avenue')
        ->with('avenue',$avenues)
        ->with('allDays',$alldays)
        ->with('selectedDays',$selectedDays);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAvenueRequest $request, $id)
    {
        $request->validated();

        
        $avenue = Avenue::findOrFail($id);

        $image= $avenue->image_id;

        if ($request->hasFile('image')) {
            $path= $request->file('image')->store('avenues','public');

            $image = Image::insertGetId(['url' => $path]);
        }
        $avenue->update([
            'name' => $request->name,
            'location' => $request->location,
            'price_per_hours' => $request->price,
            'size' => $request->size,
            'advantages' => $request->advantages,
            'image_id'=>$image
        ]);


        $daysToAdd = $request->input('addDays');
        $daysToRemove = $request->input('removeDays');
        if ($daysToAdd) {
            foreach ($daysToAdd as $dayId) {
                if (!$avenue->days->contains($dayId)) {
                    $avenue->days()->attach($dayId);
                }
            }
        }
    
        // Remove selected days
        if ($daysToRemove) {
            foreach ($daysToRemove as $dayId) {
                if ($avenue->days->contains($dayId)) {
                    $avenue->days()->detach($dayId);
                }
            }
        }
        session()->flash('success', 'Avenue updated successfully!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $avenue= Avenue::findOrFail($id);
        $avenue->delete();
        session()->flash('success', 'Avenue deleted successfully!');
        return redirect()->route('showAvenue');
    }
}
