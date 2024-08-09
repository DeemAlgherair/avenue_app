@extends('Backend.Auth.main')
@section('title','Hall plus -  Reset password')
@section('content')





<div class="container">
  <div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <div class="row d-flex justify-content-center">  
        <div class=" d-none d-lg-block bg-register-image"></div>
        <div class="col-lg-7">
          <div class="p-5 d-flex flex-column">  
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
            </div>
            <form class="user" method="POST" action="{{ route('register') }}">
              @csrf
              <div class="form-group">
                <input type="text" class="form-control form-control-user" id="exampleFirstName"
                  placeholder="Name" name="name" value="{{ old('name') }}" required>
                  <x-input-error :messages="$errors->get('name')" class="mt-2" />

              </div>
              <div class="form-group">
                <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                placeholder="Enter Email Address..."  name="email" value="{{ old('email') }}" required>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />

              </div>
              <div class="form-group">
                <input type="password" class="form-control form-control-user" id="exampleInputPassword"
                  placeholder="Password" name="password" required>
                  <x-input-error :messages="$errors->get('password')" class="mt-2" />

              </div>
              <button type="submit" class="btn btn-primary btn-user btn-block">
                Register Account
              </button>
              <hr>
            </form>
            <hr>
            <div class="text-center">
              <a class="small" href={{ route('forgotPasswordIndex') }}>Forgot Password?</a>
          </div>
          <div class="text-center">
              <a class="small" href={{ route('customerloginIndex') }}>Already have an account? Login!</a>
          </div>
           
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection