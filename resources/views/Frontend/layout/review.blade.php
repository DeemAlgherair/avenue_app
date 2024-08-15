@extends('frontend.layout.app')

@section('content')

@section('title','HALL Plus - Review')

<link rel="stylesheet" href="{{asset('Frontend/assets/css/review.css')}}">

<section class="body">
    <div class="container container1 py-5">
        <div class="row justify-content-center">
            <div class="col-24 col-md-16 col-lg-12">
                <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                    <div class="card-header bg-gradient-primary text-white border-0">
                    <h3 class="text-start m-0">Review</h3>
                </div>
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
                                        <input type="text" id="avenue_location"        value="{{ $booking->avenue->city }}, {{ $booking->avenue->neighborhood }}, {{ $booking->avenue->street }}, {{ $booking->avenue->building_number }} " class="form-control bg-light" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="avenue_price" class="form-label">Price Per Day:</label>
                                        <input type="text" id="avenue_price" value="{{ $booking->avenue->price_per_hours }}" class="form-control bg-light" readonly>
                                    </div>
                                </div>
                            </div>



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
