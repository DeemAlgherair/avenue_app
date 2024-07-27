@extends('frontend.layout.app')

@section('content')
<body>
    <section class="bg-light py-3 py-md-5 py-xl-8">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card border-light shadow-sm">
                        <!-- Card Header -->
                        <div class="card-header bg-primary text-light">
                            <h5 class="mb-0">Payment</h5>
                        </div>
                        <div class="card-body">
                            <h4 class="text-primary">Complete Your Payment</h4>
                            
                            <!-- Display invoice details -->
                            <p><strong>Serial No:</strong> {{ $booking->serial_no }}</p>
                            <p><strong>Booking Date:</strong> {{ $booking->booking_date }}</p>
                            <p><strong>Avenue Name:</strong> {{ $booking->avenue ? $booking->avenue->name : 'Not Available' }}</p>
                            <p><strong>Customer Name:</strong> {{ $booking->customer ? $booking->customer->name : 'Not Available' }}</p>
                            <p><strong>Booking Status:</strong> {{ $booking->status ? $booking->status->statues_name : 'Not Available' }}</p>
                            <p><strong>Subtotal:</strong> {{ $booking->subtotal }}</p>
                            <p><strong>Tax:</strong> {{ $booking->tax }}</p>
                            <p><strong>Total:</strong> {{ $booking->total }}</p>

                            <!-- Payment Form -->
                            <form action="{{ route('payment.process', ['booking' => $booking->id]) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="card_number">Card Number:</label>
                                    <input type="text" id="card_number" name="card_number" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="card_expiry">Card Expiry Date:</label>
                                    <input type="text" id="card_expiry" name="card_expiry" class="form-control" placeholder="MM/YY" required>
                                </div>
                                <div class="form-group">
                                    <label for="card_cvc">Card CVC:</label>
                                    <input type="text" id="card_cvc" name="card_cvc" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Pay Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@endsection
