@extends('Frontend.layout.app')

@section('title', 'Hall Plus - Login')

@section('content')
<link rel="stylesheet" href="{{ asset('Frontend/assets/css/booking.css') }}">

<section class="body py-3 justify-content-center">
    <div class="container container1 justify-content-center">
        <div class="row justify-content-center">
            <div class="col-24 col-md-16 col-lg-12">
                <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                    <div class="card-body">
                        <h3 class="mb-6 text-center text-gray-900">Forgot Your Password?</h3>
                        <h6 class="mb-6 text-center text-gray-900">We get it, stuff happens. Just enter your email address below
                            and we'll send you a link to reset your password!</h6>

                        <form method="POST" action="{{ route('forgotPasswordCustomer') }}">
                            @csrf
                            <div class="form-group mb-4" style="width: 75%; margin: 0 auto;">
                                <input type="email" class="form-control form-control-lg w-100"
                                       aria-describedby="emailHelp"
                                       placeholder="Enter Email Address..." name="email">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="form-group mt-4 text-center" style="width: 75%; margin: 0 auto;">

                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                Reset Password
                            </button>
                        </div>
                        </form>

                        <hr>

                        <div class="text-center">
                            <a class="small" href="{{ route('registerIndex') }}">Create an Account!</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="{{ route('customerloginIndex') }}">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
