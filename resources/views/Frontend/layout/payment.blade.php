@extends('frontend.layout.app')

@section('content')
<link rel="stylesheet" href="{{asset('Frontend/assets/css/review.css')}}">

@if(session()->has('success'))
<div class="alert alert-success">{{ session()->get('success') }}</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger">{{ session()->get('error') }}</div>
@endif



<section class="body py-3">
    <div class="container py-5">
        @if(session()->has('success'))
<div class="alert alert-success">{{ session()->get('success')}}</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger">{{ session()->get('error')}}</div>
@endif
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

                            <label for="user_email" class="form-label">Booking No</label>

                            <input type="text" id="user_email" value="{{ $booking->serial_no }}" class="form-control bg-light" readonly>
                            </div>
                        <div class="mb-3">
                            <label for="user_email" class="form-label">Booking Start Date:</label>
                            <input type="text" id="user_email" value=" {{  \Carbon\Carbon::parse($booking->startDate)->format('d-m-Y') }}" class="form-control bg-light" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="user_email" class="form-label">Booking End Date:</label>
                            <input type="text" id="user_email" value=" {{  \Carbon\Carbon::parse($booking->endDate)->format('d-m-Y') }}" class="form-control bg-light" readonly>
                        </div>
                    </div>
                    
                    <div class="col mb-3 avenue-info">

                                <h6 class="mb-3 form-label">Hall Details</h6>
                                <div class="mb-3">
                                    <label for="avenue_name" class="form-label">Hall Name:</label>
                                    <input type="text" id="avenue_name" value="{{ $booking->avenue->name }}" class="form-control bg-light" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="avenue_location" class="form-label">Location:</label>
                                    <input type="text" id="avenue_location" value="{{ $booking->avenue->location }}" class="form-control bg-light" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="avenue_price" class="form-label">Total Price:</label>
                                    <input type="text" id="avenue_price" value="{{ $booking->total }}" class="form-control bg-light" readonly>
                                </div>
                            </div>
                        </div>



                        <!-- Payment Form -->
                        <form action="https://api.moyasar.com/v1/payments.html" method="POST">
                                               <h6 class="mb-3 form-label">MADA CARD</h6>

                            <input type="hidden" name="callback_url" value="{{ url(route('payment.callback', [$booking->id])) }}" />
                            <input type="hidden" name="publishable_api_key" value="{{ config('services.moyasar.key') }}" />
                            <input type="hidden" name="amount" value="{{ (int) $booking->total }}" />
                            <input type="hidden" name="currency" value="SAR" />
                            <input type="hidden" name="source[type]" value="creditcard" />
                            <input type="hidden" name="description" value="Order id {{ $booking->id }} by {{ $booking->customers ? $booking->customers->name : 'Not Available' }}" />

                            <div class="form-group mb-3">
                                <input type="text" class="form-control form-control-lg" placeholder="Card Holder Name" name="source[name]" required />
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control form-control-lg" placeholder="Card Number" name="source[number]" required />
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group mb-3">
                                        <input type="number" class="form-control form-control-lg" placeholder="Expiry Month" name="source[month]" required />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mb-3">
                                        <input type="number" class="form-control form-control-lg" placeholder="Expiry Year" name="source[year]" required />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <input type="number" class="form-control form-control-lg" placeholder="CVC" name="source[cvc]" required />
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Go to Pay</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
