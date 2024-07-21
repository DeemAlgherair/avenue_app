@extends('Backend.Auth.main')
@section('title','Online Avenue - Login')
@section('content')
<title> Online Avenue - Login </title>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-3 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." name="email" value="{{ old('email') }}" required>
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />


                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password"
                                                name="password" required>
                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />



                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href={{ route('forgotPasswordIndex') }}>Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('registerIndex') }}">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection