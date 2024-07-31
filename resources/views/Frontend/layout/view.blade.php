@extends('frontend.layout.app')
@section('content')

<style>
    .star-rating {
        font-size: 30px;
        text-align: center; /* Center the stars */
    }
    .star-rating-complete {
        color: #ffc700;
    }
    .star-rating-incomplete {
        color: #ccc;
    }
    .review-section {
        text-align: center; /* Center the review section text */
    }
</style>

<div class="container my-5">
    <div class="row">
        <div class="col-md-4 order-md-2">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="card-img-top" src="{{ asset('storage/' . $avenue->image->url) }}" style="height: 500px; object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8 order-md-1">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="text-center mb-4">{{ $avenue->name ?? "Not Found :(" }}</h2>
                    <div class="mt-4 review-section">
                        <p class="font-weight-bold mb-2">Review ({{ $avenue->reviews->count() }} reviews)</p>
                        <div class="form-group">
                            <div class="star-rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $averageRating)
                                        <span class="star-rating-complete">★</span>
                                    @else
                                        <span class="star-rating-incomplete">★</span>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Location:</strong> {{ $avenue->location ?? "Not Found :(" }}
                        </li>
                        <li class="list-group-item">
                            <strong>Price per Hour:</strong> {{ $avenue->price_per_hours ?? "Not Found :(" }}
                        </li>
                        <li class="list-group-item">
                            <strong>Size:</strong> {{ $avenue->size ?? "Not Found :(" }}
                        </li>
                        <li class="list-group-item">
                            <strong>Advantages:</strong> {{ $avenue->advantages ?? "Not Found :(" }}
                        </li>
                    </ul>

                    <div class="text-center mt-4">
                        <a class="btn btn-primary btn-lg" href="/Customer-Online-Avenue/booking/{{$avenue->id}}">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
