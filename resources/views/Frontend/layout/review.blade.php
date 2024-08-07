@extends('frontend.layout.app')

@section('content')

<style>
    .rate, .rated {
        float: left;
        height: 46px;
        padding: 0 10px;
    }
    .rate:not(:checked) > input, .rated:not(:checked) > input {
        position: absolute;
        display: none;
    }
    .rate:not(:checked) > label, .rated:not(:checked) > label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }
    .rate:not(:checked) > label:before, .rated:not(:checked) > label:before {
        content: '★ ';
    }
    .rate > input:checked ~ label, .rated > input:checked ~ label {
        color: #ffc700;
    }
    .rate:not(:checked) > label:hover, .rate:not(:checked) > label:hover ~ label,
    .rated:not(:checked) > label:hover, .rated:not(:checked) > label:hover ~ label {
        color: #deb217;
    }
    .rate > input:checked + label:hover, .rate > input:checked + label:hover ~ label,
    .rate > input:checked ~ label:hover, .rate > input:checked ~ label:hover ~ label,
    .rate > label:hover ~ input:checked ~ label,
    .rated > input:checked + label:hover, .rated > input:checked + label:hover ~ label,
    .rated > input:checked ~ label:hover, .rated > input:checked ~ label:hover ~ label,
    .rated > label:hover ~ input:checked ~ label {
        color: #c59b08;
    }
    .star-rating-complete {
        color: #ffc700;
    }
</style>


<section class="bg-light py-4">
    <div class="container  py-3 py-md-5 py-xl-8 ">
        <div class="row">
            <div class="col-12">
                <div class="card border-light shadow-sm">
                    <!-- Card Header -->
                    <div class="card-header bg-primary text-light">
                        <h5 class="mb-0">Review Booking</h5>
                    </div>
                    <div class="card-body">
                        <div class="invoice">
                            <h4 class="text-primary">Booking Details</h4>
                            <p><strong>Booking No:</strong> {{ $booking->serial_no }}</p>
                            <p><strong>Booking  Start Date:</strong> {{  \Carbon\Carbon::parse($booking->startDate)->format('d-m-Y') }}</p> 
                            <p><strong>Booking End Date:</strong> {{  \Carbon\Carbon::parse($booking->endDate)->format('d-m-Y') }}</p>
                            <p><strong>Avenue Name:</strong> {{ $booking->avenue ? $booking->avenue->name : 'Not Available' }}</p>
                            <p><strong>Customer Name:</strong> {{ $booking->customer ? $booking->customer->name : 'Not Available' }}</p>
                            <p><strong>Booking Status:</strong> {{ $booking->status ? $booking->status->statues_name : 'Not Available' }}</p>
                            <p><strong>Subtotal:</strong> {{ $booking->subtotal }}</p>
                            <p><strong>Tax:</strong> {{ $booking->tax }}</p>
                            <p><strong>Total:</strong> {{ $booking->total }}</p>

                            <!-- Review Form -->
                            <form action="{{ route('review.submit', $booking->id) }}" method="POST">
                                @csrf
                                <p class="font-weight-bold">Submit Your Review</p>
                                <div class="form-group row">
                                    <div class="col d-flex justify-content-left">
                                        <div class="rate">
                                            @for ($i = 5; $i >= 1; $i--)
                                                <input type="radio" id="star{{ $i }}" name="rate" value="{{ $i }}" {{ isset($review) && $review->rate == $i ? 'checked' : '' }}/>
                                                <label for="star{{ $i }}" title="text">{{ $i }} stars</label>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mt-4">
                                    <div class="col">
                                        <label  title="text">Comment:</label>
                                        <textarea class="form-control" name="comment" rows="6" placeholder="Comment" maxlength="200" >{{ isset($review) ? $review->comment : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="mt-3 text-right">
                                    <button type="submit" class="btn btn-primary">
                                        {{ isset($review) ? 'Update Review' : 'Submit Review' }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
