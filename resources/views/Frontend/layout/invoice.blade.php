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
                            <h5 class="mb-0">Invoice</h5>
                        </div>
                        <div class="card-body">
                            <div class="invoice">
                                <h4 class="text-primary">Booking Invoice</h4>
                                <p><strong>Serial No:</strong> {{ $booking->serial_no }}</p>
                                <p><strong>Booking Date:</strong> {{ $booking->booking_date }}</p>
                                
                                <!-- Check if avenue is not null -->
                                <p><strong>Avenue Name:</strong> {{ $booking->avenues ? $booking->avenues->name : 'Not Available' }}</p>
<p><strong>Customer Name:</strong> {{ $booking->customers ? $booking->customers->name : 'Not Available' }}</p>
<p><strong>Booking Status:</strong> {{ $booking->status ? $booking->status->status_name : 'Not Available' }}</p>



                                <p><strong>Subtotal:</strong> {{ $booking->subtotal }}</p>
                                <p><strong>Tax:</strong> {{ $booking->tax }}</p>
                                <p><strong>Total:</strong> {{ $booking->total }}</p>
                                
                                <!-- Button to proceed to payment -->
                                
                                <form action="{{ route('bookings.success', ['booking' => $booking->id]) }}"  method="GET">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Proceed to Payment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@endsection
