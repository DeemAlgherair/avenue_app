@extends('Backend.app')
@section('title','Online Avenue - Edit Reservations')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Reservations</h6>
        </div>
        <div class="card-body">
<form action="{{ route('updateReservation', $bookings->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="form-group">
        <label for="name">avenue_id</label>
        <input type="text" class="form-control" id="name" name="avenue_id" value="{{ $bookings->avenue_id}}" required>
    </div>
    <div class="form-group">
        <label for="email">customer_id</label>
        <input type="email" class="form-control" id="email" name="customer_id" value="{{ $bookings->customer_id}}" required>
    </div>
    <div class="form-group">
        <label for="phone">total</label>
        <input type="text" class="form-control" id="phone" name="total" value="{{ $bookings->total }}" required>
    </div>
    <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to update this owner?')">Update Reservation</button>
    </form>
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
