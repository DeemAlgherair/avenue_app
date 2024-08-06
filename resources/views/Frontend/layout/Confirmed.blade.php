@extends('frontend.layout.app')

@section('content')
<script src="{{ asset('Frontend/assets/timer.js') }}"></script>

<section class="bg-light ">
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
                            <div class="row">
                                @foreach ($confirmedBookings as $booking)
                                @php
                                $shadowClass = ($booking->status_id == 4 || $booking->status_id == 5) ? 'shadow-on' : 'shadow';
                            @endphp
                                    <div class="col-md-4 mb-3">
                                        <div class="card border-light {{ $shadowClass }}">
                                            <div class="card-body">
                                                <p><strong class="mb-3">Booking #{{ $booking->serial_no }}</strong></p>
                                                <p><strong>Booking Date:</strong> {{ $booking->booking_date }}</p>
                                                <p><strong>Avenue Name:</strong> {{ $booking->avenues->name ?? 'Not Available' }}</p>
                                                <p><strong>Customer Name:</strong> {{ $booking->customers->name ?? 'Not Available' }}</p>

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
                                                    <div class="d-flex align-items-center mt-2">
                                                        <span class="text-warning ">Waiting for Approval</span>
                                                        <div id="timer-waiting-{{ $booking->id }}" class="timer-waiting py-2 btn d-flex align-items-center ms-2"
                                                             data-start-time="{{ now()->timestamp }}" data-duration="300">Loading...</div>
                                                    </div>
                                                    <span id="timeout-message-{{ $booking->id }}" style="display:none; color:red;">Time is up! Please try again.</span>
                                                    <form id="update-status-form-{{ $booking->id }}" action="{{ route('updateBookingStatus', $booking->id) }}" method="POST" style="display:none;">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="5">
                                                    </form>
                                                @elseif($booking->status_id == 5)
                                                    <p class="text-danger">Not Approved</p>
                                                @elseif($booking->status_id == 4)
                                                    <p class="text-danger">Payment failed</p>
                                                @endif
                                                @if($booking->status_id == 3)
                                                    <span class="btn btn-success disabled">Paid</span>
                                                    <a class="btn btn-primary" href="/Customer-Online-Avenue/invoice/{{$booking->id}}">Invoice</a>
                                                @elseif($booking->status_id == 2)
                                                    <div class="d-flex align-items-center mt-2">
                                                        <a href="{{ route('payment.show', $booking->id) }}" class="btn btn-success" id="pay-button-{{ $booking->id }}">Pay</a>
                                                        <div id="timer1-{{ $booking->id }}" class="timer py-2 btn ms-3"
                                                             data-start-time="{{ now()->timestamp }}" data-duration="300">Loading...</div>
                                                    </div>
                                                    <span id="timeout-message-{{ $booking->id }}" style="display:none; color:red;">Time is up! Please try again.</span>
                                                    <form id="update-status-form-{{ $booking->id }}" action="{{ route('updateBookingStatus', $booking->id) }}" method="POST" style="display:none;">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="4">
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .shadow {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }
    .shadow-on
    {
        box-shadow:0px 0px 1px rgba(29, 29, 29, 0.75);

    
    }
</style>

@endsection
