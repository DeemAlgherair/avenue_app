@extends('frontend.layout.app')
@section('title','HALL Plus ')

@section('content')
<link rel="stylesheet" href="{{asset('Frontend/assets/css/booking.css')}}">

<section class="py-5">
    <div class="container container1">
        <div class="row justify-content-center">
            <div class="col-24 col-md-16 col-lg-12">
                <div class="card border-0 shadow-lg rounded-lg">
                    <!-- Card Header -->
                    <div class="card-header bg-gradient-primary text-white text-center py-4">
                        <h3 class="mb-0">🎉Payment Successfull🎉</h3>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body text-center">
                        <h5 class="text-muted mb-3">Thank you for choosing us! ❤</h5>
                    <!-- Card Footer -->
                    <div class="card-footer text-center bg-light py-3">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
  