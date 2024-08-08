@extends('Backend.app')
@section('title','Hall plus - Show Reservations')
@section('content')
<script src="{{ asset('Frontend/assets/timer.js') }}"></script>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Reservations</h6>
        </div>
        <div class="card-body">
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="GET" action="{{ route('searchReservations') }}">
                <div class="input-group">
                    <input type="text" name="query" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
            <br><br>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Serial_No</th>
                            <th>Avenue</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Payment Status</th>
                            <th>Reservation Status</th>
                            <th>Details</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $key => $booking)
                        <tr>
                            <th scope="row">{{ ++$key }}</th>
                            <td>{{ $booking->serial_no }}</td>
                            <td>{{ $booking->avenues->name }}</td>
                            <td>{{ $booking->customers->name }}</td>
                            <td>{{ $booking->total }}</td>
                            <td>
                                @if ($booking->status->id == 4)
                                <span class="badge badge-danger">Payment failed</span>
                                @elseif ($booking->status->id == 3)
                                    <span class="badge badge-success">Payment succeeded</span>
                                @elseif ($booking->status->id == 2)
                                    <span class="badge badge-warning">Waiting for payment</span>
                                @else
                                    <span class="badge badge-secondary">Unknown</span>
                                @endif
                            </td>
                            <td>
                                @if ($booking->status->id == 1)
                                <form action="{{ route('confiremdBooking', $booking->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <div class="d-flex align-items-center">

                                    <button type="submit" class="btn btn-danger btn-sm pending-button" id="timer-waiting-{{ $booking->id }}" onclick="return confirm('Are you sure you want to confirm this reservation?')">Click to Approve</button>
                                </form>
                                    <div id="timer-waiting-{{ $booking->id }}" class="timer-waiting btn d-flex align-items-center" data-start-time="{{ now()->timestamp }}" data-duration="300">Loading...</div>
                                </div>
                                    <span id="timeout-message-{{ $booking->id }}" style="display:none; color:red;">Time is up! Please try again.</span>
                                    <form id="update-status-form-{{ $booking->id }}" action="{{ route('updateBookingStatus', $booking->id) }}" method="POST" style="display:none;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="5">
                                    </form>
                                </div>
                                @elseif($booking->status->id == 5)
                                    <span class="badge badge-danger">Not approved</span>
                                @else
                                    <span class="badge badge-success">Approved</span>
                                @endif
                            </td>
                            <td>
                                <a href="/Admin-Online-Avenue/show-reservation/{{$booking->id}}/datail-reservation" class="btn btn-primary btn-sm">Detail</a>
                            </td>
                            <td>
                                <form action="{{ route('deleteReservation', $booking->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this reservation?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
