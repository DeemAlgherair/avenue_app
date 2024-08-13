@extends('Backend.app')
@section('title', 'Hall Plus - Create Owner')
@section('content')

<link rel="stylesheet" href="{{ asset('Frontend/assets/phone/css/intlTelInput.css') }}">

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Owner</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('createOwner') }}" method="POST" id="form">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}" placeholder="Enter owner name">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}" placeholder="Enter owner email">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter owner phone number">
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    <input type="hidden" name="full_phone" id="full_phone">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Add Owner</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('Frontend/assets/phone/js/intlTelInput.js') }}"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
  const input = document.getElementById("phone");
  const fullPhoneInput = document.getElementById("full_phone");
  let iti;

  if (input) {
    iti = window.intlTelInput(input, {
      utilsScript: '{{ asset('Frontend/assets/phone/js/utils.js') }}',
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


@endsection
