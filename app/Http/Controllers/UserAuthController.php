<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\LoginRequset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;
use App\Http\Requests\StorForgetPassowrdRequset;
use App\Http\Requests\StoreUserRequset;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\ResetPasswordToken;
use App\Mail\RestPasswordMail;

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
        if (Customer::where('email',  $request->email)->exists()) {
            toastr()->error('The email has already been taken.');
            return back();
        }
        if (Customer::where('phone', $request->full_phone)->exists()) {
            toastr()->error('Phone number has already been taken.');
            return back();
        }
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->full_phone,
            'password' => Hash::make($request->password),
            'last_login'=>now()
        ]);

        Auth::login($customer);

        Mail::to($customer->email)->send(new RegisterMail($customer));


        return redirect()->route('customerLogin');
    }

    public function logout(Request $request) {
        Auth::guard('customers')->logout();
        $request->session()->invalidate();    
        return redirect()->route('customerLogin');
}
public function forgotPasswordCustomerIndex()
{
    return view('Backend.Auth.forgot-password-customer');
}

public function forgotPasswordCustomer(Request $request)
{
    $request->validate([
        'email' => 'required|email:rfc,dns|string|max:255|exists:customers,email',
    ]);
        // Make a random token using Str
        $token = Str::random(120);

        // Save the token in the database
        //make a new token
        $reset_password_token = ResetPasswordToken::updateOrCreate(
            ['email' => $request->email],  // Match by email
            ['token' => Hash::make($token)] // Update or set the token
        );
        
        $user = Customer::where('email', $request->email)->firstOrFail();
        $name = $user->name;
        $email = $user->email;
        
        
        // Send email to the user
        Mail::to($request->email)->send(new RestPasswordMail($name, $token, $email));//Mailer
        toastr()->success('Password reset email has been sent successfully. Please check your email inbox');
        return redirect('/forgot-password-customer');
    
    }


public function resetPassword($token, Request $request)
{

    $request->validate([
        'email' => 'required|string|exists:reset_password_tokens,email' ,  ]);

    //check the token
    $reset_password_tokens = ResetPasswordToken::where('email', $request->email)->firstOrFail();


    //check if the token expierd or not 
    $finishTime = Carbon::now();
    $totalDuration = $reset_password_tokens->created_at->diffInMinutes( $finishTime);

    if (! Hash::check($token, $reset_password_tokens->token)) {
        toastr()->error('Unauthenticated reset password');
        return back();
    }
    
    if ($totalDuration > 60) {
        toastr()->error('Token has been expired');
        return redirect('forgot-password-customer');
    }
    
    return view('Backend.Auth.reset-password-customer')->with('email',$request->email);

    
}



public function storeResetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|string|exists:reset_password_tokens,email' , 
        'password'=>'required|string|min:8|confirmed',
    ]);
    $user = Customer::where('email', $request->email)->firstOrFail();
    $user->password = Hash::make($request->password);
    $user->update();

    ResetPasswordToken::where('email',$request->email)->delete();
    toastr()->success('Password reset successfully.');

    return redirect('/login-customer');

} 

}
