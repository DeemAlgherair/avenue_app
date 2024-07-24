@extends('Backend.app')
@section('title','Online Avenue -  Dashboard')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
 <div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Dashboard</h6>
        </div>
        <div class="card-body">
        <div class="row">
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Owners</h5>
        <p class="card-text">Registerd Owners : {{$owners}}</p>
        <a href="{{route('showOwner')}}" class="btn btn-primary">view</a>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Reservations</h5>
        <p class="card-text">All Reservations : {{$bookings}}</p>
        <a href="{{route('showReservation')}}" class="btn btn-primary">View</a>
      </div>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Avenues</h5>
        <p class="card-text">Registerd Avenues: {{$avenues}}</p>
        <a href="{{route('showAvenue')}}" class="btn btn-primary">View</a>
      </div>
    </div>
  </div>
</div>


        </div>
    </div>
  </div>
</div>
@endsection
