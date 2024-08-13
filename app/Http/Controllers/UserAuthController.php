<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\LoginRequset;
use Illuminate\Http\Request;

use App\Http\Requests\StoreUserRequset;

class UserAuthController extends Controller
{

    public function index()
    {
        return view('Backend.Auth.customer-login');
    }
    public function registerIndex()
    {
        return view('Backend.Auth.register');


    }

    public function customerLogin(LoginRequset $request)
    {
        $request->validated();
        if(!Auth::guard('customers')->attempt(['email' => $request->email,'password' => $request->password])) 
        {
            toastr()->error('Email or Password are Invalid');
            return back();
    }
    $request->session()->regenerate();
    return redirect()->route('home');
}
    public function register(StoreUserRequset $request) {
        $request->validated();
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->full_phone,
            'password' => Hash::make($request->password),
            'last_login'=>now()
        ]);

        Auth::login($customer);

        //Mail::to($user->email)->send(new RegisterMail($user));


        return redirect()->route('customerLogin');
    }

    public function logout(Request $request) {
        Auth::guard('customers')->logout();
        $request->session()->invalidate();    
        return redirect()->route('customerLogin');
}
    

}
