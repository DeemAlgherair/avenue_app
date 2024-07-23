@extends('Backend.app')
@section('title','Online Avenue - Show Reservations')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Reservations</h6>
        </div>
        <div class="card-body">
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
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as  $key => $booking)
                        <tr>
                            <th scope="row">{{ ++$key }}</th>
                            <td>{{ $booking->serial_no}}</td>
                            <td>{{ $booking->avenue_id}}</td>
                            <td>{{ $booking->customer_id}}</td>
                            <td>{{ $booking->total}}</td>
                            <td>{{ $booking->status_id}}</td>

                            <td>
                                <!-- Edit Button -->
                                <a href="/Admin-Online-Avenue/show-reservation/{{$booking->id}}/edit-reservation" class="btn btn-primary btn-sm">Edit</a>
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
