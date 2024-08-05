@extends('frontend.layout.app')

@section('content')
@if(session()->has('success'))
<div class="alert alert-success">{{ session()->get('success')}}</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger">{{ session()->get('error')}}</div>
@endif
<body>
    <section class="bg-light py-3 py-md-5 py-xl-8">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card border-light shadow-sm">
                        <!-- Card Header -->
                        <div class="card-header bg-primary text-light ">
                            <h5 class="mb-0">Payment</h5>
                        </div>
                        <div class="card-body">
                            <h4 class="text-primary">Complete Your Payment</h4>
                            <!-- Display invoice details -->
                            <p><strong>Serial No:</strong> {{ $booking->serial_no }}</p>
                            <p><strong>Booking Date:</strong> {{ $booking->booking_date }}</p>
                            <p><strong>Avenue Name:</strong> {{ $booking->avenues ? $booking->avenues->name : 'Not Available' }}</p>
                            <p><strong>Customer Name:</strong> {{ $booking->customers ? $booking->customers->name : 'Not Available' }}</p>
                            <p><strong>Booking Status:</strong> {{ $booking->status ? $booking->status->statues_name : 'Not Available' }}</p>
                            <p><strong>Subtotal:</strong> {{ $booking->subtotal }}</p>
                            <p><strong>Tax:</strong> {{ $booking->tax }}</p>
                            <p><strong>Total:</strong> {{ $booking->total }}</p>

                            <!-- Payment Form -->
                            <h3>Payment</h3>
                            <form accept-charset="UTF-8" action="https://api.moyasar.com/v1/payments.html" method="POST">
                                <input type="hidden" name="callback_url" value="{{ url(route('payment.callback', [$booking->id])) }}" />
                                <input type="hidden" name="publishable_api_key" value="{{ config('services.moyasar.key') }}" />
                                <input type="hidden" name="amount" value="{{ (int) $booking->total  }}" />
                                <input type="hidden" name="currency" value="SAR" />
                                <input type="hidden" name="source[type]" value="creditcard" />
                                <input type="hidden" name="description" value="Order id {{ $booking->id }} by {{ $booking->customers ? $booking->customers->name : 'Not Available' }}" />

                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Card Holder Name" name="source[name]" />
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Card Number" name="source[number]" />
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" placeholder="Expiry Month" name="source[month]" />
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" placeholder="Expiry Year" name="source[year]" />
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" placeholder="CVC" name="source[cvc]" />
                                </div>

                                <button type="submit" class="btn btn-primary">Go to Pay</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

@endsection
