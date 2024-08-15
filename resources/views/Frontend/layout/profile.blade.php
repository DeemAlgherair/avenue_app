@extends('frontend.layout.app')
@section('title', 'Hall Plus - Profile')
@section('content')
<link rel="stylesheet" href="{{asset('Frontend/assets/css/booking.css')}}">
<link rel="stylesheet" href="{{ asset('Frontend/assets/phone/css/intlTelInput.css') }}">

<section class="body py-3">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-24 col-md-16 col-lg-12">
            <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                <div class="card-header bg-gradient-primary text-white border-0 d-flex justify-content-between align-items-center">
                    <h3 class="text-start mb-0">Profile</h3>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-light">Back</a>
                </div>
                                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 d-flex flex-column align-items-center">
                            <div class="profile-image mb-4">
                                <img class="img-fluid rounded-circle" style="width: 150px; height: 150px;" src="{{ asset('storage/' . $customer->profile_pic) }}" alt="Profile Image">
                            </div>
                            <form action="{{ route('updateProfile', $customer->id) }}" method="POST" enctype="multipart/form-data" id="form">
                                @csrf
                                @method('PATCH')
                                <div class="form-group text-center">
                                    <label for="image" class="btn btn-outline-primary">
                                        <input type="file" id="image" name="image" class="d-none">
                                        Change Profile Picture
                                    </label>
                                </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="customerName" class ="form-label">Name</label>
                                <input type="text" class="form-control" id="customerName" name="name" value="{{ $customer->name }}" placeholder="Enter your name">
                            </div>
                            <div class="form-group">
                                <label for="customerEmail" class ="form-label">Email</label>
                                <input type="email" class="form-control" id="customerEmail" name="email" value="{{ $customer->email }}" placeholder="Enter your email">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="form-group py-3">
                                <label for="phone" class="form-label">Phone</label>
<input type="tel" class="form-control" id="phone" name="phone" value="{{ $customer->phone }}" placeholder="Enter your phone number">
                                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                    <input type="hidden" name="full_phone" id="full_phone">
                            </div>
                            <div class="form-group">
                                <label for="adminPassword" class ="form-label">New Password</label>
                                <input type="password" class="form-control" id="adminPassword" name="password" placeholder="Enter new password">
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <div class="form-group">
                                <label for="adminPasswordConfirm" class ="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="adminPasswordConfirm" name="password_confirmation" placeholder="Confirm new password">
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                            <div class="form-group  mt-4">
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

@endsection

<script src="{{ asset('Frontend/assets/phone/js/intlTelInput.js') }}"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
  const input = document.getElementById("phone");
  const fullPhoneInput = document.getElementById("full_phone");
  let iti;

  if (input) {
    iti = window.intlTelInput(input, {
      utilsScript: "{{ asset('Frontend/assets/phone/js/utils.js') }}",
      initialCountry: 'auto',
      autoHideDialCode: true,
      nationalMode: true,
    });

    function updateFullPhone() {
      if (iti) {
        const fullPhoneNumber = iti.getNumber();
        fullPhoneInput.value = fullPhoneNumber;
      }
    }

    document.getElementById("form").addEventListener("submit", updateFullPhone);
  }
});

</script>
