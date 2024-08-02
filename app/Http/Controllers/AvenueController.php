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


    public function store(StoreAvenueRequest $request,$owner_id)
    {
    $request->validated();


    // Create the avenue
    $avenue = Avenue::create([
        'name' => $request->name,
        'location' => $request->location,
        'price_per_hours' => $request->price,
        'size' => $request->size,
        'advantages' => $request->advantages,
        'serial_no' => $this->generateUniqueSerialNumber(),
        'owener_id' => $owner_id,
    ]);
    
    $mainImagePath = $request->file('image')->store('avenues', 'public');

    $mainImage = Avenue_Image::create([
        'avenue_id' => $avenue->id,
        'url' => $mainImagePath,
        'is_main' => true,
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    if ($request->hasFile('other_images')) {
        foreach ($request->file('other_images') as $image) {

            $path = $image->store('avenues', 'public');
            $image = Avenue_Image::create([
                    'avenue_id' => $avenue->id,
                    'url' => $path,
                    'is_main' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                
            ]);
        }

    }
   

    if ($request->has('days')) {
        $validated = $request->validate([
            'days' => 'required|array|min:1',
            'days.*' => 'integer|exists:days,id', 
        ]);
        $avenue->days()->sync($validated['days']);
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
         $totalReviews = $reviews->count();
         $averageRating = $reviews->avg('rate');
         $reviewCounts = [
            5 => $reviews->where('rate', 5)->count(),
            4 => $reviews->where('rate', 4)->count(),
            3 => $reviews->where('rate', 3)->count(),
            2 => $reviews->where('rate', 2)->count(),
            1 => $reviews->where('rate', 1)->count(),
        ]; 
         $images = Avenue_Image::where('avenue_id', $id)->get();
         return view('Frontend.layout.view')
         ->with('avenue', $avenue)
         ->with('images', $images)
         ->with('reviewCounts', $reviewCounts)
         ->with('totalReviews', $totalReviews)
         ->with('averageRating',$averageRating);
         
    }

    public function edit($id)
    {
        $avenues = Avenue::with(['owner', 'days'])->findOrFail($id);
        $images = Avenue_Image::where('avenue_id', $id)->get();
        $alldays = Day::all();
        $selectedDays = $avenues->days->pluck('id')->toArray();
        return view ('Backend.Avenue.edit-avenue')
        ->with('avenue',$avenues)
        ->with('images',$images)
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
        $avenue->update([
            'name' => $request->name,
            'location' => $request->location,
            'price_per_hours' => $request->price,
            'size' => $request->size,
            'advantages' => $request->advantages,
        ]);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('avenues', 'public');
            $mainImage = Avenue_Image::where('avenue_id', $avenue->id)->where('is_main', true)->first();
            $mainImage->update(['url' => $path]);
            
        }
    
        if ($request->hasFile('other_images')) {
            foreach ($request->file('other_images') as $imageId => $imageFile) {
                $path = $imageFile->store('avenues', 'public');
                $imageFile = Avenue_Image::where('avenue_id', $avenue->id)->where('is_main', false)->where('id',$imageId);
                $imageFile->update(['url' => $path]);
            }
        }
    

        $daysToAdd = $request->input('addDays');
        $daysToRemove = $request->input('removeDays');
        if ($daysToAdd) {
            foreach ($daysToAdd as $dayId) {
                if (!$avenue->days->contains($dayId)) {
                    $avenue->days()->attach($dayId);
                }
            }
        }
    
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
