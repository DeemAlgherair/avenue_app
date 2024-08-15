@extends('frontend.layout.app')

@section('content')
@section('title','HALL+ plus - Booking')

<link rel="stylesheet" href="{{asset('Frontend/assets/css/booking.css')}}">

<section class="body py-3  justify-content-center">
    <div class="container container1 justify-content-center">
        <div class="row justify-content-center">
            <div class="col-24 col-md-16 col-lg-12">
                <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                    <div class="card-header bg-gradient-primary text-white border-0">
                        <h3 class="mb-0">Booking</h3>
                    </div>
                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('bookings.store', ['avenueId' => $selectedAvenue->id]) }}">
                            @csrf
                            <div class="row row-cols-md-2">
                                <!-- User Information Section -->
                                <div class="col mb-3 avenue-info">
                                    <h6 class="mb-3 form-label">Personal Details</h6>
                                    <div class="mb-3">
                                        <label for="user_name" class="form-label">Name:</label>
                                        <input type="text" id="user_name" value="{{ Auth::guard('customers')->user()->name }}" class="form-control bg-light" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="user_phone" class="form-label">Phone Number:</label>
                                        <input type="text" id="user_phone" value="{{ Auth::guard('customers')->user()->phone }}" class="form-control bg-light" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="user_email" class="form-label">Email:</label>
                                        <input type="text" id="user_email" value="{{ Auth::guard('customers')->user()->email }}" class="form-control bg-light" readonly>
                                    </div>
                                </div>

                                <!-- Avenue Information Section -->
                                <div class="col mb-3 avenue-info">
                                    <h6 class="mb-3 form-label">Hall Details</h6>
                                    <div class="mb-3">
                                        <label for="avenue_name" class="form-label">Name:</label>
                                        <input type="text" id="avenue_name" value="{{ $selectedAvenue->name }}" class="form-control bg-light" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="avenue_location" class="form-label">Location:</label>
                                        <input type="text" id="avenue_location" value="{{ $selectedAvenue->city }}, {{ $selectedAvenue->neighborhood }}, {{ $selectedAvenue->street }}, {{ $selectedAvenue->building_number }}" class="form-control bg-light" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="avenue_price" class="form-label">Price Per Day:</label>
                                        <input type="text" id="avenue_price" value="{{ $selectedAvenue->price_per_hours }}" class="form-control bg-light" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date:</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" required>
                            </div>

                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date:</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" required>
                            </div>

                            <div class="d-grid gap-2">
                                <button class="btn btn-primary btn-lg" type="submit">Book Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>


@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(function() {
        var dtToday = new Date();
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();

        if (month < 10) month = '0' + month;
        if (day < 10) day = '0' + day;

        var maxDate = year + '-' + month + '-' + day;
        $('#start_date').attr('min', maxDate);
        $('#end_date').attr('min', maxDate);
    });
</script>
