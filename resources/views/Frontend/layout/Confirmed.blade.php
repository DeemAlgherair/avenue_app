@extends('frontend.layout.app')
@section('title','HALL Plus - My Reservations')

@section('content')
<script src="{{ asset('Frontend/assets/timer.js') }}"></script>
<link rel="stylesheet" href="{{asset('Frontend/assets/css/allBooking.css')}}">
@if(session()->has('success'))
<div class="alert alert-success">{{ session()->get('success') }}</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger">{{ session()->get('error') }}</div>
@endif

<section class="bg-light">
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <!-- Card Header -->
                    
                    <div class="card-header bg-gradient-primary text-white border-0 py-3 d-flex justify-content-between align-items-center">
                        <h3 class="text-start mb-0">My Bookings</h3>
                        <a href="{{ url()->previous() }}" class="btn btn-outline-light">Back</a>
                    </div>
                    <div class="card-body ">
                        <div class="d-flex justify-content-between align-items-center py-2">
                            <form method="GET" action ="{{route('confirmed.bookings')}}"class="d-flex">
                                <select name="filter" class="form-select me-2">
                                    <option value="latest" {{ request('filter') == 'latest' ? 'selected' : '' }}>Latest</option>
                                    <option value="oldest" {{ request('filter') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                                    <option value="paid" {{ request('filter') == 'paid' ? 'selected' : '' }}>Paid</option>
                                    <option value="not_approved" {{ request('filter') == 'not_approved' ? 'selected' : '' }}>Canceled</option>
                                </select>
                                <button type="submit" class="btn btn-light">Filter</button>
                            </form>
                        </div>
                        @if($confirmedBookings->isEmpty())
                        <p class="text-center text-muted">No bookings available.</p>
                    @else
                        <div class="row">
                            @foreach ($confirmedBookings as $booking)
                            @php
                            $bgClass = ($booking->status_id == 4 || $booking->status_id == 5) ? 'bg-gray' : '';
                            $shadowClass = ($booking->status_id == 4 || $booking->status_id == 5) ? 'shadow-error' : 'shadow-default';
                            @endphp
                                <div class="col-md-4 mb-4">
                                    <div class="card border-light {{ $shadowClass }} rounded-3 {{ $bgClass }}">
                                        <div class="card-body">
                                            <h6 class="card-title mb-3">Booking #{{ $booking->serial_no }}</h6>
                                            <p><strong>Created at:</strong> {{ \Carbon\Carbon::parse($booking->created_at)->format('d-m-Y') }}</p>
                                            <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($booking->startDate)->format('d-m-Y') }}</p>
                                            <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($booking->endDate)->format('d-m-Y') }}</p>
                                            <p><strong>Hall Name:</strong> {{ $booking->avenues->name ?? 'Not Available' }}</p>
                                            <p><strong>Customer Name:</strong> {{ $booking->customers->name ?? 'Not Available' }}</p>
                    
                                            @php
                                                $reviewed = $booking->reviews()->where('customer_id', $booking->customers->id)->exists();
                                            @endphp
                                            
                                            @if ($reviewed)
                                                <a href="{{ route('review.booking', $booking->id) }}" class="btn btn-secondary btn-sm">Reviewed</a>
                                            @else
                                                @if($booking->status_id == 3)
                                                    <a href="{{ route('review.booking', $booking->id) }}" class="btn btn-primary btn-sm">Review</a>
                                                @endif
                                            @endif
                                            
                                            @if($booking->status_id == 1)
                                                <div class="d-flex align-items-center mt-2">
                                                    <span class="waiting btn text-light btn py-1 px-2">Watring for Approval
                                                    <div id="timer-waiting-{{ $booking->id }}" class="timer-waiting btn text-light py-1 px-2"
                                                         data-start-time="{{ now()->timestamp }}" data-duration="300">Loading...</div>
                                                </div></span>
                                                <span id="timeout-message-{{ $booking->id }}" class="text-danger" style="display:none;">Time is up! Please try again.</span>
                                                <form id="update-status-form-{{ $booking->id }}" action="{{ route('updateBookingStatus', $booking->id) }}" method="POST" style="display:none;">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="5">
                                                </form>
                                            @elseif($booking->status_id == 5)
                                                <p class="text-danger">Not Approved</p>
                                            @elseif($booking->status_id == 4)
                                                <p class="text-danger">Payment Failed</p>
                                            @endif
                                            @if($booking->status_id == 3)
                                                <span class="btn btn-success btn-sm disabled">Paid</span>
                                                <a class="btn btn-primary btn-sm" href="/Customer-HALL-PLUS/invoice/{{$booking->id}}">Invoice</a>
                                            @elseif($booking->status_id == 2)
                                                <div class="d-flex align-items-center mt-2">
                                                    <a href="{{ route('payment.show', $booking->id) }}" class="btn btn-success btn-sm" id="pay-button-{{ $booking->id }}" style="padding-left: 1rem;">Pay
                                                    <div id="timer1-{{ $booking->id }}" class="timer btn text-light ms-3 py-1 px-2"
                                                         data-start-time="{{ now()->timestamp }}" data-duration="300">Loading...</div></a>
                                                </div>
                                                <span id="timeout-message-{{ $booking->id }}" class="text-danger" style="display:none;">Time is up! Please try again.</span>
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


@endsection