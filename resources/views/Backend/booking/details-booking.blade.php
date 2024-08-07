@extends('Backend.app')
@section('title','Online Avenue - Show Reservations Details')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Details Reservations</h6>
        </div>
         <div class="card-body">
         <div class="row">
        <div class="col mb-2">
          <label for="phone">Serial_No</label>
          <input type="text" class="form-control"name="serial_no" value="{{$bookings->serial_no}}">
        </div>
        <div class="col mb-2">
         <label for="name">Booking Strat Date</label>
         <input type="text" class="form-control" name="avenue_id" value="{{ \Carbon\Carbon::parse($bookings->startDate)->format('d-m-Y') }}">
        </div>
        <div class="col mb-2">
          <label for="name">Booking End Date</label>
          <input type="text" class="form-control" name="avenue_id" value="{{  \Carbon\Carbon::parse($bookings->endDate)->format('d-m-Y') }}">
         </div>
        </div>
        <div class="row">
        <div class="col mb-2">
         <label for="name">Avenues Name</label>
         <input type="text" class="form-control" name="avenue_id" value="{{ $bookings->avenues->name}}">
        </div>
        <div class="col mb-2">
         <label for="email">Customers Name</label>
         <input type="text" class="form-control" name="customer_id" value="{{ $bookings->customers->name}}">
        </div>
        </div>
        <div class="row">
        <div class="col mb-2">
         <label for="phone">Subtotal</label>
          <input type="text" class="form-control" name="total" value="{{ $bookings->subtotal}}">
        </div>
        <div class="col mb-2">
         <label for="phone">Tax</label>
          <input type="text" class="form-control" name="total" value="{{ $bookings->tax}}">
        </div>
        <div class="col mb-2">
         <label for="phone">Total</label>
          <input type="text" class="form-control" name="total" value="{{ $bookings->total }}">
        </div>
        </div>
        <div class="col mb-2">
          <label for="phone">Status</label>
          <input type="text" class="form-control" name="total" value="{{  $bookings->booking_statuses->statues_name }}">
        </div>
        <br>
        <div class="row">
          <div class="col-12">
          <a href="/Admin-Online-Avenue/show-reservation/{{$bookings->id}}/print-invoice"class="btn btn-primary btn-sm ml-auto"><i class="fas fa-print"></i>&nbsp;&nbsp; print invoice</a>
          </div>
        </div>
    </div>
</div>
@endsection