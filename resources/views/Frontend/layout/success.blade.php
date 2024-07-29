@extends('frontend.layout.app')

@section('content')
<section class="bg-light py-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card border-light shadow-sm">
                    <div class="card-header bg-success text-light">
                        <h5 class="mb-0">Booking Successful</h5>
                    </div>
                    <div class="card-body">
                        <p>Your booking has been successfully submitted. Please wait for confirmation from the host.</p>
                        <p>Once confirmed, you will receive further instructions on how to complete your payment.</p>
                        <a href="{{ route('home') }}" class="btn btn-primary">Go to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
