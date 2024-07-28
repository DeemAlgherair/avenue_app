@extends('frontend.layout.app') 
@section('content') 
<body> 
    <section class="bg-light py-3 py-md-5 py-xl-8"> 
        <div class="container"> 
            <div class="row"> 
                <div class="col-md-10 mx-auto"> 
                    <div class="card border-light shadow-sm"> 
                        <!-- Card Header --> 
                        <div class="card-header bg-warning text-dark"> 
                            <h5 class="mb-0">Unconfirmed Bookings</h5> 
                        </div> 
                        <div class="card-body"> 
                            @if($unconfirmedBookings->isEmpty()) 
                                <p>No unconfirmed bookings available.</p> 
                            @else 
                                <table class="table table-striped"> 
                                    <thead> 
                                        <tr> 
                                            <th>Serial No</th> 
                                            <th>Booking Date</th> 
                                            <th>Avenue Name</th> 
                                            <th>Customer Name</th> 
                                            <th>Actions</th> 
                                        </tr> 
                                    </thead> 
                                    <tbody> 
                                        @foreach ($unconfirmedBookings as $booking) 
                                            <tr> 
                                                <td>{{ $booking->serial_no }}</td> 
                                                <td>{{ $booking->booking_date }}</td> 
                                                <td>{{ $booking->avenues->name ?? 'Not Available' }}</td> 
                                                <td>{{ $booking->customers->name ?? 'Not Available' }}</td> 
                                                <td> 
                                                   
                                                    <!-- Button to Go to Payment Page --> 
                                                    <a href="{{ route('payment.show', $booking->id) }}" class="btn btn-success">Pay</a> 
                                                </td> 
                                            </tr> 
                                        @endforeach 
                                    </tbody> 
                                </table> 
                            @endif 
                        </div> 
                    </div> 
                </div> 
            </div> 
        </div> 
    </section> 
</body> 
@endsection