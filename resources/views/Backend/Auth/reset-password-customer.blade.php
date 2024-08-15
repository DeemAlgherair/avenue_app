
@extends('Backend.Auth.main')
@section('title','Hall plus-  Reset password')
@section('content')

<body class="bg-gradient-primary">

    <div class="container">


        <div class="container">
            <div class="card o-hidden border-0 shadow-lg my-5">
              <div class="card-body p-0">
                <div class="row d-flex justify-content-center">  
                  <div class=" d-none d-lg-block bg-register-image"></div>
                  <div class="col-lg-7">
                    <div class="p-5 d-flex flex-column">  
                      <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Reset Your Password?</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your new password below</p>
                                    </div>
                                    <form method="POST" action = "{{route('resetPassowrd')}}" >
                                        @csrf
                                        
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." name ="email"readonly value = "{{old('email',$email)}} ">
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Enter New Password"
                                                name="password" required>
                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />

                                                    <div class="form-group">
                                                        <input type="password" class="form-control form-control-user" id="exampleInputConfirmPassword" placeholder="Confirm New Password" name="password_confirmation" required>
                                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                                      </div>
                                       
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Reset Password
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{route('registerIndex')}}">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{route('loginIndex')}}">Already have an account? Login!</a>
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