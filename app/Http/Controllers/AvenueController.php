<?php

namespace App\Http\Controllers;

use App\Models\Avenue;
use App\Models\Avenue_Day;
use App\Models\Day;
use App\Models\Owner;
use App\Models\Review;
use App\Models\Avenue_Advantage;
use App\Models\Advantage;
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
        $Avenueadvantages = Advantage::all();
        $status = Avenue_Day::with(['status'])->get();
        return view ('Backend.Avenue.create-avenue')->with('days',$days)->with('status',$status)
        ->with('owner_id', $owner_id )->with('Avenueadvantages', $Avenueadvantages );
    }
    public function store(StoreAvenueRequest $request,$owner_id)
    {
     
    $request->validated();

    $avenue = Avenue::create([
        'name' => $request->name,
        'city' => $request->city,
        'neighborhood' => $request->neighborhood,
        'street' => $request->street,
        'building_number' => $request->building_number,
        'price_per_hours' => $request->price,
        'size' => $request->size,
        'advantages' => $request->note,
        'serial_no' => $this->generateUniqueSerialNumber(), 
        'owener_id' =>$owner_id
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

    
    if ($request->has('avenueadvantages')) {
        
        $avenue->avenueadvantage()->sync($request->input('avenueadvantages'));}
         else 
    {
        $avenue->avenueadvantage()->sync([]);
    }
   

    session()->flash('success', 'Hall created successfully!');
    return redirect()->route('showAvenue');
}
public function edit($id)
    {
        $avenues = Avenue::with(['owner', 'days','image','avenueadvantage'])->findOrFail($id);
        $alldays = Day::all();
        $Avenueadvantages = Advantage::all();
        $selectedDays = $avenues->days->pluck('id')->toArray();
        $images = Avenue_Image::where('avenue_id', $id)->get();

        return view ('Backend.Avenue.edit-avenue')
        ->with('avenue',$avenues)
        ->with('allDays',$alldays)
        ->with('images',$images)
        ->with('selectedDays',$selectedDays)->with('Avenueadvantages',$Avenueadvantages);
    }
 

    public function show($id)
    {
        $avenue = Avenue::with('reviews')->findOrFail($id);
        
        
        $reviews = Review::where('avenue_id',$id)->get();
        
        // Calculations
        $totalReviews = $reviews->count();
        $averageRating = $reviews->avg('rate');
        $reviewCounts = [
            5 => $reviews->where('rate', 5)->count(),
            4 => $reviews->where('rate', 4)->count(),
            3 => $reviews->where('rate', 3)->count(),
            2 => $reviews->where('rate', 2)->count(),
            1 => $reviews->where('rate', 1)->count(),
        ];
        
        // Other Data
        $Avenueadvantages = Advantage::all();
        $images = Avenue_Image::where('avenue_id', $id)->get();
        
        
        return view('Frontend.layout.view')
            ->with('avenue', $avenue)
            ->with('images', $images)
            ->with('reviews', $reviews) 
            ->with('reviewCounts', $reviewCounts)
            ->with('totalReviews', $totalReviews)
            ->with('Avenueadvantages', $Avenueadvantages)
            ->with('averageRating', $averageRating);
    }
        public function update(UpdateAvenueRequest $request, $id)
    {
        // Validate the request
        $request->validated();
    
        $avenue = Avenue::findOrFail($id);

        $avenue->update([
            'name' => $request->name,
            'city' => $request->city,
            'neighborhood' => $request->neighborhood,
            'street' => $request->street,
            'building_number' => $request->building_number,
            'price_per_hours' => $request->price,
            'size' => $request->size,
            'advantages' => $request->note,
        ]);
    
      
        
    
        // Sync the advantages relationship
        $advToAdd = $request->input('addAdv');
        $advToRemove = $request->input('removeAdv');
    
        if ($advToAdd) {
            foreach ($advToAdd as $advId) {
                if (!$avenue->avenueadvantage->contains($advId)) {
                    $avenue->avenueadvantage()->attach($advId);
                }
            }
        }
    
        if ($advToRemove) {
            foreach ($advToRemove as $advId) {
                if ($avenue->avenueadvantage->contains($advId)) {
                    $avenue->avenueadvantage()->detach($advId);
                }
            }
        }
    
        // Flash success message and redirect back
        session()->flash('success', 'Hall updated successfully!');
        return back();
    }
    

   
    public function destroy($id)
    {
        $image = Avenue_Image::where('avenue_id',$id)->delete();
        $avenue= Avenue::findOrFail($id);
        $avenue->delete();
        session()->flash('success', 'Hall deleted successfully!');
        return redirect()->route('showAvenue');
    }


    public function updateImage(Request $request, $id)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('avenues', 'public');
            $mainImage = Avenue_Image::where('avenue_id', $id)->where('is_main', true)->first();
            $mainImage->update(['url' => $path]);
        }
    
        if ($request->hasFile('other_images')) {
            foreach ($request->file('other_images') as $imageId => $imageFile) {
                $path = $imageFile->store('avenues', 'public');
                $imageFile = Avenue_Image::where('avenue_id', $id)->where('is_main', false)->where('id', $imageId)->first();
                $imageFile->update(['url' => $path]);
            }
        }
   
    
        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $image) {
    
                $path = $image->store('avenues', 'public');
                $image = Avenue_Image::create([
                        'avenue_id' => $id,
                        'url' => $path,
                        'is_main' => false,
                        'created_at' => now(),
                        'updated_at' => now(),
                    
                ]);
            }
    
        }
        session()->flash('success', 'Images updated successfully!');

        return back();
    }
    
    public function deleteImage(Request $request, $id)
    {
        $image = Avenue_Image::find($id);
    
        if ($image) {
            $image->delete();
            session()->flash('success', 'Images deleted successfully!');
            return back();
        }
        session()->flash('error', 'Image not found.');

        return back();
    }
    
    


public function search(Request $request) {
    $query = $request->input('query');
    $avenues = Avenue::where('name', 'LIKE', '%' . $query . '%')
    ->orWhereHas('owners', function ($q) use ($query) {
       $q->where('name', 'LIKE', '%' . $query . '%');})->get();


    return view('Backend.Avenue.search', compact('avenues'));
}






}
