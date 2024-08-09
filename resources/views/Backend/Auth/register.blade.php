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
                        <h3 class="mb-6 text-center text-gray-900">Create Account</h3>

                        <form action="{{ route('register') }}" method="POST">
                            @csrf
                            <div class="form-group mb-4" style="width: 75%; margin: 0 auto;">
                              <input type="test" class="form-control form-control-lg w-100" id="exampleInputEmail" 
                                     placeholder="Enter Your Name" name="name" value="{{ old('bame') }}" required>
                              <x-input-error :messages="$errors->get('name')" class="mt-2" />
                          </div>
                            <div class="form-group mb-4" style="width: 75%; margin: 0 auto;">
                                <input type="email" class="form-control form-control-lg w-100" id="exampleInputEmail" 
                                       placeholder="Enter Email Address" name="email" value="{{ old('email') }}" required>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="form-group mb-4" style="width: 75%; margin: 0 auto;">
                                <input type="password" class="form-control form-control-lg w-100" id="exampleInputPassword" 
                                       placeholder="Enter Password" name="password" required>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <div class="form-group mt-4 text-center" style="width: 75%; margin: 0 auto;">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    Register
                                </button>
                            </div>
                        </form>
                        <div class="text-center mt-4">
                        </div>
                        <div class="text-center mt-2">
                            <a class="" href="{{ route('customerloginIndex') }}">Already have an acount? Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
