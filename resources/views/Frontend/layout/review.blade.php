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
                            <h5 class="mb-0">Review Booking</h5>
                        </div>
                        <div class="card-body">
                            <div class="invoice">
                                <h4 class="text-primary">Booking Details</h4>
                                <p><strong>Serial No:</strong> {{ $booking->serial_no }}</p>
                                <p><strong>Booking Date:</strong> {{ $booking->booking_date }}</p>
                                <p><strong>Avenue Name:</strong> {{ $booking->avenue ? $booking->avenue->name : 'Not Available' }}</p>
                                <p><strong>Customer Name:</strong> {{ $booking->customer ? $booking->customer->name : 'Not Available' }}</p>
                                <p><strong>Booking Status:</strong> {{ $booking->status ? $booking->status->statues_name : 'Not Available' }}</p>
                                <p><strong>Subtotal:</strong> {{ $booking->subtotal }}</p>
                                <p><strong>Tax:</strong> {{ $booking->tax }}</p>
                                <p><strong>Total:</strong> {{ $booking->total }}</p>

                                <!-- Review Form -->
                                <form  action="{{ route('review.submit', $booking->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="rate">Rating (1-5):</label>
                                        <input type="number" id="rate" name="rate" class="form-control" min="1" max="5" value="{{ old('rate', $review->rate ?? '') }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">Your Review:</label>
                                        <textarea id="comment" name="comment" class="form-control" rows="4" required>{{ old('comment', $review->comment ?? '') }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        {{ $review ? 'Update Review' : 'Submit Review' }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<div class=" d-flex justify-content-center mt-5">
    <div class=" text-center mb-5">
            <div class="rating"> <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label> </div>
            <div class="buttons  mt-0"> <button class="btn btn-info px-4 py-1 rating-submit ">Submit</button> </div>
        </div>
    </div>
</div>
@endsection
