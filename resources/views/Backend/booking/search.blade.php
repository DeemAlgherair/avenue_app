@extends('Backend.app')
@section('title','Online Avenue - Show Reservations')
@section('content')
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
                            <th>Status</th>
                            <th>Details</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as  $key => $booking)
                        <tr>
                            <th scope="row">{{ ++$key }}</th>
                            <td>{{ $booking->serial_no}}</td>
                            <td>{{ $booking->avenues->name}}</td>
                            <td>{{ $booking->customers->name}}</td>
                            <td>{{ $booking->total}}</td>
                            <td>
                            @if($booking->status->id == 1)
                            <form action="{{ route('confiremdBooking', $booking->id) }}" method="POST" style="display:inline;">
                                @csrf
                               @method('PUT')
                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to confirmed this reservation?')">Pending</button>
                            </form>
                            @else
                            completed
                        </td>
                        @endif
                         
                            <td>
                            <a href="/Admin-Online-Avenue/show-reservation/{{$booking->id}}/datail-reservation" class="btn btn-primary btn-sm">Detail</a>
                            </td>
                            <td>
                            <form action="{{ route('deleteReservation', $booking->id) }}" method="POST" style="display:inline;">
                                @csrf
                               @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this owner?')">Delete</button>
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
<!-- /.container-fluid -->
@endsection