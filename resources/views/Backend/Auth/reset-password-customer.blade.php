@extends('Frontend.layout.app')
@section('title','Hall Plus - Reset Password')
@section('content')
<link rel="stylesheet" href="{{ asset('Frontend/assets/css/booking.css') }}">

<section class="body py-3 justify-content-center">
    <div class="container container1 justify-content-center">
        <div class="row justify-content-center">
            <div class="col-24 col-md-16 col-lg-12">
                <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                    <div class="card-body">
                        <h3 class="mb-6 text-center text-gray-900">Reset Your Password</h3>
                        <h6 class="mb-6 text-center text-gray-900">We get it, stuff happens. Just enter your new password below.</h6>
                    </div>
                    <form method="POST" action="{{ route('resetPassowrdCustomer') }}">
                        @csrf
                        <div class="form-group mb-4" style="width: 75%; margin: 0 auto;">
                            <input type="email" class="form-control form-control-lg"
                                   id="exampleInputEmail" aria-describedby="emailHelp"
                                   placeholder="Enter Email Address..." name="email" readonly value="{{ old('email', $email) }}">
                        </div>
                        <div class="form-group mb-4" style="width: 75%; margin: 0 auto;">
                            <input type="password" class="form-control form-control-lg"
                                   id="exampleInputPassword" placeholder="Enter New Password"
                                   name="password" required>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div class="form-group mb-4" style="width: 75%; margin: 0 auto;">
                            <input type="password" class="form-control form-control-lg"
                                   id="exampleInputConfirmPassword" placeholder="Confirm New Password"
                                   name="password_confirmation" required>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                        <div class="form-group mt-4 text-center" style="width: 75%; margin: 0 auto;">

                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            Reset Password
                        </button>
                    </div>
                    </form>
                    <div class="text-center mt-4">
                    </div>
                    <div class="text-center mt-2">
                        <a class="" href="{{ route('registerIndex') }}">Create an Account!</a>
                    </div>
                    <div class="text-center mt-2 mb-3">
                        <a class="" href="{{ route('customerloginIndex') }}">Already have an account? Login!</a>
                    </div>
        </div>
    </div>
@endsection
