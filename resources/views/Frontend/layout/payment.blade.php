@extends('frontend.layout.app')
@section('title', 'HALL Plus - Payment')

@section('content')
<link rel="stylesheet" href="{{ asset('Frontend/assets/css/booking.css') }}">

@if(session()->has('success'))
    <div class="alert alert-success">{{ session()->get('success') }}</div>
@endif
@if(session()->has('error'))
    <div class="alert alert-danger">{{ session()->get('error') }}</div>
@endif

<section class="body py-3">
    <div class="container py-5">
        <section class="body">
            <div class="container container1">
                <div class="row justify-content-center">
                    <div class="col-24 col-md-16 col-lg-12">
                        <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                            <div class="card-header bg-gradient-primary text-white border-0">
                                <h3 class="mb-0">Payment</h3>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="row row-cols-md-2">
                                    <div class="col mb-3 avenue-info">
                                        <h6 class="mb-3 form-label">Booking Details</h6>
                                        <div class="mb-3">
                                            <label for="booking_no" class="form-label">Booking No</label>
                                            <input type="text" id="booking_no" value="{{ $booking->serial_no }}" class="form-control bg-light" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="start_date" class="form-label">Booking Start Date:</label>
                                            <input type="text" id="start_date" value="{{ \Carbon\Carbon::parse($booking->startDate)->format('d-m-Y') }}" class="form-control bg-light" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="end_date" class="form-label">Booking End Date:</label>
                                            <input type="text" id="end_date" value="{{ \Carbon\Carbon::parse($booking->endDate)->format('d-m-Y') }}" class="form-control bg-light" readonly>
                                        </div>
                                    </div>

                                    <div class="col mb-3 avenue-info">
                                        <h6 class="mb-3 form-label">Hall Details</h6>
                                        <div class="mb-3">
                                            <label for="hall_name" class="form-label">Hall Name:</label>
                                            <input type="text" id="hall_name" value="{{ $booking->avenues->name }}" class="form-control bg-light" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="hall_location" class="form-label">Location:</label>
                                            <input type="text" id="hall_location" value="{{ $booking->avenues->location }}" class="form-control bg-light" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="total_price" class="form-label">Total Price:</label>
                                            <input type="text" id="total_price" value="${{ number_format($booking->total, 2) }}" class="form-control bg-light" readonly>
                                        </div>
                                    </div>
                                </div>

                                <!-- Stripe Payment Button -->
                                <form action="{{ route('pay', ['bookingId' => $booking->id]) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="payment_method" value="checkout">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">Pay with Stripe</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
@endsection
