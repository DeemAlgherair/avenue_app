@extends('frontend.layout.app')
@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container my-5">
    <div class="row">
        
        <div class="col-md-4 order-md-2">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="card-img-top" src="{{ asset('storage/' . $avenue->image->url) }}" style="height: 500px; z-index: -5;">
                    </div>
                </div>
                <!-- <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                    <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
                    <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                </svg> -->
                <!-- <span class="ms-2 fs-7">{{ $avenue->published_at ?? "Not Published yet" }}</span> -->

            </div>
        </div>
        <div class="col-md-8 order-md-1">
            <h2 class="text-center mb-4">{{ $avenue->name ?? "Not Found :(" }}</h2>

            <p>Location: {{ $avenue->location ?? "Not Found :(" }}</p>
            <p>Price per Hour: {{ $avenue->price_per_hours ?? "Not Found :(" }}</p>
            <p>Size: {{ $avenue->size ?? "Not Found :(" }}</p>
            <p>Advantages: {{ $avenue->advantages ?? "Not Found :(" }}</p>
            <a class="btn  btn-primary" href="/Customer-Online-Avenue/booking/{{$avenue->id}}" >Booking</a>
        </div>
    </div>
</div>

@endsection
