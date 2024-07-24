@extends('Backend.app')
@section('title','Online Avenue - Edit Reservations')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Reservations</h6>
        </div>
        <div class="card-body">
<form action="" method="POST">
<div class="row">
<div class="col">
  <label for="phone">Serial_No</label>
    <input type="text" class="form-control"name="serial_no" value="{{$bookings->serial_no}}">
  </div>
  <div class="col">
  <label for="name">Avenues Name</label>
    <input type="text" class="form-control" name="avenue_id" value="{{ $bookings->avenues->name}}">
  </div>
  <div class="col">
  <label for="email">Customers Name</label>
    <input type="text" class="form-control" name="customer_id" value="{{ $bookings->customers->name}}">
  </div>
  <div class="col">
  <label for="phone">Total</label>
    <input type="text" class="form-control" name="total" value="{{ $bookings->total }}">
  </div>
  <div class="col">
  <label for="phone">Status</label>
    <input type="text" class="form-control" name="total" value="{{  $bookings->booking_statuses->statues_name }}">
  </div>
</div>
<br>
<br>
    <form action="{{ route('deleteReservation', $bookings->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this owner?')">Delete Reservation</button>
    </form>
        </div>
        </div> 
 
    </div>
</div>
@endsection
