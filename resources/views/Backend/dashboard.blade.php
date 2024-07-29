@extends('Backend.app')
@section('title', 'Online Avenue - Dashboard')
@section('content')
<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <div class="row">
    <div class="col-md-4 mb-4">
      <div class="card shadow">
        <div class="card-header py-3 d-flex align-items-center">
          <i class="fas fa-users fa-lg"></i>
          <h6 class="m-0 font-weight-bold text-primary ml-2">Owners</h6>
        </div>
        <div class="card-body">
          <a href="{{ route('showOwner') }}" class="btn btn-primary">View</a>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="card shadow">
        <div class="card-header py-3 d-flex align-items-center">
          <i class="fas fa-calendar-alt fa-lg"></i>
          <h6 class="m-0 font-weight-bold text-primary ml-2">Reservations</h6>
        </div>
        <div class="card-body">
          <a href="{{ route('showReservation') }}" class="btn btn-primary">View</a>
        </div>
      </div>
    </div>

    <div class="col-md-4 mb-4">
      <div class="card shadow">
        <div class="card-header py-3 d-flex align-items-center">
          <i class="fas fa-building fa-lg"></i>
          <h6 class="m-0 font-weight-bold text-primary ml-2">Avenues</h6>
        </div>
        <div class="card-body">
          <a href="{{ route('showAvenue') }}" class="btn btn-primary">View</a>
        </div>
      </div>
    </div>

    <div class="col-md-6 mb-3">
      <div class="card shadow">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Charts</h6>
        </div>
        <div class="card-body">
          <div class="stats">
            <div style="width: 80%; margin: auto;">
              <canvas id="barChart"></canvas>
            </div>
            <script>
var ctx = document.getElementById('barChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: @json($data['labels']),
        datasets: [{
            label: '#',
            data: @json($data['data']),
            backgroundColor: ["rgba(75, 192, 192, 0.2)","rgba(255, 192, 203, 0.2)","rgba(255, 255, 0, 0.2)","rgba(200, 162, 235, 0.2)"],
            borderColor: ["rgba(75, 192, 192, 1)","rgba(255, 192, 203, 1)","rgba(255, 255, 0, 1)","rgba(200, 162, 235, 1)"],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true, 
                min: 0,
                stepSize: 1,
                ticks: { precision: 0 },

            }
        }
    }
});            </script>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection

