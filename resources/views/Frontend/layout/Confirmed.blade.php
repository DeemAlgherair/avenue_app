@extends('frontend.layout.app')
@section('content')
<body>
    <section class="bg-light py-3 py-md-5 py-xl-8">
        <div class="container">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="card border-light shadow-sm">
                        <!-- Card Header -->
                        <div class="card-header bg-primary text-light">
                            <h5 class="mb-0">Confirmed Bookings</h5>
                        </div>
                        <div class="card-body">
                            @if($confirmedBookings->isEmpty())
                                <p>No confirmed bookings available.</p>
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
                                                <td>{{ $booking->avenue->name ?? 'Not Available' }}</td>
                                                <td>{{ $booking->customer->name ?? 'Not Available' }}</td>
                                                <td>
                                                    <a href="{{ route('review.booking', $booking->id) }}" class="btn btn-primary">Review</a>
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
