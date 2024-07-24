<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Auth;
use Illuminate\Support\Facades\Hash;
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

        /* 
        validate([
            'name' => 'required|string|max:255',
            "email"=>"required|email:rfc,dns|string|max:255",
            "password"=>"required|min:3|max:255",
        ]);*/ 

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($customer);

        //Mail::to($user->email)->send(new RegisterMail($user));


        return redirect()->route('customerLogin');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();    
        return redirect()->route('customerLogin');
}
    

}
