
@extends('Backend.Auth.main')
@section('title','Hall plus -  Reset password')
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
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                            and we'll send you a link to reset your password!</p>
                                    </div>
                                    <form method="POST" action="{{ route('forgotPassword') }}">
                                        @csrf
                                
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                               aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." name ="email">
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />

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