@extends('frontend.layout.app')

@section('content')
<link rel="stylesheet" href="{{asset('Frontend/assets/css/booking.css')}}">

<section class="py-5">
    <div class="container container1">
        <div class="row justify-content-center">
            <div class="col-24 col-md-16 col-lg-12">
                <div class="card border-0 shadow-lg rounded-lg">
                    <!-- Card Header -->
                    <div class="card-header bg-gradient-primary text-white text-center py-4">
                        <h3 class="mb-0">🎉Booking Successfully Submitted 🎉</h3>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body text-center">
                        <h5 class="text-muted mb-3">Thank you for choosing us! ❤</h5>
                        <p class="lead">Your booking has been successfully submitted.</p>
                        <p class="text-muted">Please wait for approval from the host. <br>Once approved, you will receive further instructions on how to complete your payment.</p>
                        <p class="text-muted">You can check your reservation details by clicking the button below.</p>
                        <a href="{{ route('confirmed.bookings') }}" class="btn btn-primary btn-lg mt-3">My Reservations</a>
                    </div>
                    <!-- Card Footer -->
                    <div class="card-footer text-center bg-light py-3">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
  