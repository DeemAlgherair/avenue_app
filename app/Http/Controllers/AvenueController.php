<?php

namespace App\Http\Controllers;

use App\Models\Avenue;
use App\Models\Avenue_Day;
use App\Models\Day;

use App\Models\Avenue_Image;
use App\Models\Image;
use Illuminate\Support\Str;


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
    public function create()
    {
        $days = Day::all();
        $status = Avenue_Day::with(['status'])->get();
        return view ('Backend.Avenue.create-avenue')->with('days',$days)->with('status',$status);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAvenueRequest $request)
    {

    $request->validated();

    //
    $path= $request->file('image')->store('avenues','public');
    $image = Image::insertGetId(['url' => $path]);

    //$avenue_image =Avenue_Image::create(['images_id' =>  $image->id]);
    $serial_number = Str::random(10);

    $avenue = Avenue::create([
        'name' => $request->name,
        'avenue_day_id' => $request->day,
        'location' => $request->location,
        'price_per_hours' => $request->price,
        'size' => $request->size,
        'advantages' => $request->advantages,
        'image_id' => $image,
        'serial_no' => $serial_number, 
    ]);

    //$avenue_image =Avenue::update(['images_id' =>  $image->id]);

    session()->flash('success', 'Avenue created successfully!');
    return redirect()->route('showAvenue');
}


    /**
     * Display the specified resource.
     */
    public function show( $id)
    {    $avenue = Avenue::findOrFail($id);
        
         return view('Frontend.layout.view')->with('avenue', $avenue);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $avenues = Avenue::with(['owner', 'days','image'])->findOrFail($id);
        return view ('Backend.Avenue.edit-avenue')->with('avenue',$avenues);

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
            'avenue_day_id' => $request->day,
            'location' => $request->location,
            'price_per_hours' => $request->price,
            'size' => $request->size,
            'advantages' => $request->advantages,
            'image_id'=>$image
        ]);
    
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
