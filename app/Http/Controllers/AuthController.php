<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequset;
use Auth;
use App\Models\User;
use App\Models\Owner;
use App\Models\ResetPasswordToken;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;
use App\Mail\UserRequest;
use App\Mail\RestPasswordMail;
use App\Http\Requests\LoginRequset;
use App\Http\Requests\StorForgetPassowrdRequset;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function loginIndex()
    {
        return view('Backend.Auth.login');


    }
    
   /*
    public function register(StoreUserRequset $request) {
        $request->validated();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        Mail::to($user->email)->send(new RegisterMail($user));


        return redirect()->route('AdminDashboard');
    }
*/
    
    public function login(LoginRequset $request){

        $request->validated();
        $email = $request->validated()['email'];
        $user = User::where('email', $email)->first();
      
        if (!$user) {
          return back()->withErrors(['email' => 'Invalid email ']); 
        }
      
        if (!Hash::check($request->password, $user->password)) {
          return back()->withErrors(['password' => 'Invalid  password']); 
        }

        $credential = $request->only('email','password');
        if(auth()->attempt($credential))
        {
            $request->session()->regenerate();

            return redirect()->route('AdminDashboard');
                }
        return back();
    }
  

      public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();    
        return redirect()->route('login');
}

public function forgotPasswordIndex()
{
    return view('Backend.Auth.forgot-password');
}

public function forgotPassword(StorForgetPassowrdRequset $request)
{
        // Make a random token using Str
        $token = Str::random(120);

        // Save the token in the database
        //make a new token
        $reset_password_token = ResetPasswordToken::updateOrCreate(
            ['email' => $request->email],  // Match by email
            ['token' => Hash::make($token)] // Update or set the token
        );
        
        $user = User::where('email', $request->email)->firstOrFail();
        $name = $user->name;
        $email = $user->email;
        
        
        // Send email to the user
        Mail::to($request->email)->send(new RestPasswordMail($name, $token, $email));//Mailer
        toastr()->success('Password reset email has been sent successfully. Please check your email inbox');
        return redirect('/forgot-password');
    
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
        return redirect('forgot-password');
    }
    
    return view('Backend.Auth.reset-password')->with('email',$request->email);

    
}



public function storeResetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|string|exists:reset_password_tokens,email' , 
        'password'=>'required|string|min:8|confirmed',
    ]);
    $user = User::where('email', $request->email)->firstOrFail();
    $user->password = Hash::make($request->password);
    $user->update();

    ResetPasswordToken::where('email',$request->email)->delete();
    toastr()->success('Password reset successfully.');

    return redirect('/login');

}

}
