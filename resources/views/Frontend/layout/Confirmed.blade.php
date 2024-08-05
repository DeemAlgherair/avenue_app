@extends('frontend.layout.app')

@section('content')
<script src="{{ asset('Frontend/assets/timer.js') }}"></script>

</style>
    <section class="bg-light py-4">
        <div class="container py-3 py-md-5 py-xl-8">
            <div class="row">
                <div class="col-12">
                    <div class="card border-light shadow-sm">
                        <!-- Card Header -->
                        <div class="card-header bg-primary text-light">
                            <h5 class="mb-0">My Bookings</h5>
                        </div>
                        <div class="card-body">
                            @if($confirmedBookings->isEmpty())
                                <p>No booking available.</p>
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
                                        @foreach ($confirmedBookings as $booking)
                                            <tr>
                                                <td>{{ $booking->serial_no }}</td>
                                                <td>{{ $booking->booking_date }}</td>
                                                <td>{{ $booking->avenues->name ?? 'Not Available' }}</td>
                                                <td>{{ $booking->customers->name ?? 'Not Available' }}</td>
                                                <td>
                                                    @php
                                                        $reviewed = $booking->reviews()->where('customer_id', $booking->customers->id)->exists();
                                                    @endphp
                                                    
                                                    @if ($reviewed)
                                                        <a href="{{ route('review.booking', $booking->id) }}" class="btn btn-secondary">Reviewed</a>
                                                    @else
                                                        @if($booking->status_id == 3)
                                                            <a href="{{ route('review.booking', $booking->id) }}" class="btn btn-primary">Review</a>
                                                        @endif
                                                    @endif
                                                    @if($booking->status_id == 1)
                                                        <!-- Show Waiting Status if Not Confirmed -->
                                                        <div class="d-flex align-items-center">

                                                        <span class="text-warning">Waiting for Approval</span>
                                                            <div id="timer-waiting-{{ $booking->id }}" class="timer-waiting py-2 btn d-flex align-items-center"
                                                                 data-start-time="{{ now()->timestamp }}" data-duration="300">Loading...</div>    
                                                    </div>
                                                        <span id="timeout-message-{{ $booking->id }}" style="display:none; color:red;">Time is up! Please try again.</span>
                                                        <form id="update-status-form-{{ $booking->id }}" action="{{ route('updateBookingStatus', $booking->id) }}" method="POST" style="display:none;">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="status" value="5">
                                                        </form>
                                                        @continue
                                                    @elseif($booking->status_id == 5)
                                                        <span class="text-danger">Not Approved</span>
                                                        @continue
                                                    @elseif($booking->status_id == 4)
                                                        <span class="text-danger">Payment failed</span>
                                                        @continue
                                                    @endif
                                                    @if($booking->status_id == 3)
                                                        <span class="btn btn-success disabled">Paid</span>
                                                        <a class="btn btn-primary" href="/Customer-Online-Avenue/invoice/{{$booking->id}}">Invoice</a>
                                                        @elseif($booking->status_id == 4)
                                                        <span class="text-danger">Payment failed</span>
                                                        @continue
                                                    @else
                                                        <div class="d-flex align-items-center">
                                                            <a href="{{ route('payment.show', $booking->id) }}" class="btn btn-success" id="pay-button-{{ $booking->id }}">Pay</a>
                                                            <div id="timer1-{{ $booking->id }}" class="timer py-2 btn " 
                                                                 data-start-time="{{ now()->timestamp }}" 
                                                                 data-duration="300">Loading...</div>
                                                        </div>
                                                        <span id="timeout-message-{{ $booking->id }}" style="display:none; color:red;">Time is up! Please try again.</span>
                                                        <form id="update-status-form-{{ $booking->id }}" action="{{ route('updateBookingStatus', $booking->id) }}" method="POST" style="display:none;">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="status" value="4">
                                                        </form>
                                                    @endif

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
  
@endsection
 
