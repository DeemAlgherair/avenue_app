<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Customer;
use App\Models\User;

use Illuminate\Support\Facades\Hash;


use Illuminate\Support\Facades\DB;

class profileController extends Controller
{
    public function index()
    {
       return view('Frontend.layout.profile');
    }
    public function adminIndex()
    {
        $admin = User::findOrFail(Auth::user()->id);
       return view('Backend.admin-profile')->with('admin',$admin);
    }
    public function info($id)
    {
        $customer = Customer::findOrFail($id);
       return view('Frontend.layout.profile')->with('customer',$customer); 
       
       
    }
    
   public function edit(Request $request): View
   {
       return view('Frontend.layout.editProfile', [
           'user' => $request->user(),
       ]);
   }


   public function update(Request $request ,$id)
   {

   
    $request->validate([
        'name' => 'required|string|max:255',
        'email'=> 'required|email:rfc,dns|string|max:255',
        'phone' => 'required|string|max:20|min:6',
        'profile_pic' =>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'password' =>'nullable|confirmed|min:8|max:16',
    
    ]);
         $customer = Customer::find($id);  
         $path = $customer->profile_pic; 
         
         if ($request->hasFile('image')) {
           $path = $request->file('image')->store('customers', 'public');
         }
         $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone'=> $request->phone,
            'profile_pic'=> $path,
            'password' => $request->has('password') ? Hash::make($request->password) : $customer->password,

        ]);

        session()->flash('success', 'Profile updated successfully!');

        return back();

   }
   public function adminUpdateProfile(Request $request)
   {

   
    $request->validate([
        'name' => 'required|string|max:255',
        'email'=> 'required|email:rfc,dns|string|max:255',
        'profile_pic' =>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'password' =>'nullable|confirmed|min:8|max:16',
    
    ]);
         $admin = User::findOrFail(Auth::user()->id);  
         $path = $admin->profile_pic; 
       
  
         if ($request->hasFile('image')) {
           $path = $request->file('image')->store('admin', 'public');
         }
         $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'profile_pic'=>$path,
            'password' => $request->has('password') ? Hash::make($request->password) : $admin->password,
        ]);

        session()->flash('success', 'Profile updated successfully!');

        return back();

   }

   /**
    * Delete the user's account.
    */
   public function destroy(Request $request,$id): RedirectResponse
   {
       $user = Customer::find($id);
       $user->delete();
       Auth::guard('customers')->logout();
       $request->session()->invalidate();
       $request->session()->regenerateToken();
       return redirect('/');
   }
}
