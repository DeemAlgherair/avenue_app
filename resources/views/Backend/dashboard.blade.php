@extends('Backend.app')

@section('title', 'Hall plus - Dashboard')

@section('content')
<div class="container-fluid">

  <!-- Dashboard Header -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <!-- Dashboard Summary -->
  <div class="row mb-4">
    <div class="col-md-4 mb-4">
      <div class="card shadow">
        <div class="card-header py-3 d-flex align-items-center">
          <i class="fas fa-users fa-lg"></i>
          <h6 class="m-2 font-weight-bold text-primary">Owners</h6>
        </div>
        <div class="card-body">
          <h5>Number of Owners: {{ $owners }}</h5>
          <a href="{{ route('showOwner') }}" class="btn btn-primary">View</a>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="card shadow">
        <div class="card-header py-3 d-flex align-items-center">
          <i class="fas fa-calendar-alt fa-lg"></i>
          <h6 class="m-2 font-weight-bold text-primary">Reservations</h6>
        </div>
        <div class="card-body">
          <h5>Number of Reservations: {{ $bookings }}</h5>
          <a href="{{ route('showReservation') }}" class="btn btn-primary">View</a>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="card shadow">
        <div class="card-header py-3 d-flex align-items-center">
          <i class="fas fa-building fa-lg"></i>
          <h6 class="m-2 font-weight-bold text-primary">Avenues</h6>
        </div>
        <div class="card-body">
          <h5>Number of Avenues: {{ $avenues }}</h5>
          <a href="{{ route('showAvenue') }}" class="btn btn-primary">View</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Quick Actions -->
  <div class="row mb-2">
    <div class="col-md-6 mb-3">
      <div class="card shadow">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
        </div>
        <div class="card-body">
          <a href="{{ route('showReservation') }}" class="btn btn-success">+ Manage Reservations</a>
          <a href="{{ route('createOwner') }}" class="btn btn-success">+ New Owner</a>
          <a href="{{ route('showOwner') }}" class="btn btn-success">+ Manage Owners</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Charts Section -->
  <div class="row mb-4">
    <!-- Reservations Over Time Chart -->
    <div class="col-md-6 mb-3">
      <div class="card shadow">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Reservations Over Time</h6>
        </div>
        <div class="card-body">
          <div style="width: 100%; height: 300px; margin: auto;">
            <canvas id="reservationsChart"></canvas>
          </div>
        </div>
      </div>
    </div>

    <!-- Reviews Over Avenue Chart -->
    <div class="col-md-6 mb-3">
      <div class="card shadow">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Reviews Over Avenue</h6>
        </div>
        <div class="card-body">
          <div style="width: 100%; height: 300px; margin: auto;">
            <canvas id="reviewsChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Reservations Over Time Chart
    var ctx1 = document.getElementById('reservationsChart').getContext('2d');
    var reservationsChart = new Chart(ctx1, {
      type: 'line',
      data: {
        labels: @json($reservationsData->pluck('date')),
        datasets: [{
          label: 'Reservations',
          data: @json($reservationsData->pluck('count')),
          borderColor: 'rgba(75, 192, 192, 1)',
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          fill: true
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // Reviews Over Avenue Chart
    var ctx2 = document.getElementById('reviewsChart').getContext('2d');
    var reviewsChart = new Chart(ctx2, {
      type: 'bar',
      data: {
        labels: @json($reviewsData->pluck('label')),
        datasets: [{
          label: 'Reviews',
          data: @json($reviewsData->pluck('count')),
          backgroundColor: 'rgba(255, 159, 64, 0.2)',
          borderColor: 'rgba(255, 159, 64, 1)',
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>

</div>
@endsection
