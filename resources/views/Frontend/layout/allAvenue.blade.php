@extends('frontend.layout.app')

@section('content')
<style>
    .star-rating {
        font-size: 20px;
        text-align: center;
    }
    .star-rating-complete {
        color: #ffc700;
    }
    .star-rating-incomplete {
        color: #ccc;
    }
    .review-section {
        text-align: center;
        margin-bottom: 1rem;
    }
    .card-img-top {
        border-bottom: 1px solid #ddd;
    }
    .card-body {
        padding: 1.25rem;
    }
    .entry-header {
        margin-bottom: 1rem;
    }
    .entry-meta {
        margin-bottom: 1rem;
    }
    .entry-title {
        margin-bottom: 1rem;
        text-align: center;
    }
    .card {
        border: 1px solid #ddd;
        border-radius: 0.5rem;
    }
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #ddd;
    }
    .card-img-zoom {
        transition: transform 0.3s ease;
    }
    .card-img-zoom:hover {
        transform: scale(1.05);
    }
</style>

<section class="bg-light py-3 py-md-5 py-xl-8">
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header ">       
        <div class="row gy-4 gy-md-5 gx-xl-6 gy-xl-6 gx-xxl-9 gy-xxl-9 py-7">
            @foreach ($avenues as $avenue)
                <div class="col-12 col-lg-4">
                    <article>
                        <div class="card shadow-sm border-0 bg-transparent">
                            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                            <figure class="position-relative card-img-top card-img-zoom rounded-3 overflow-hidden mb-3">
                                <a href="#!">
                                    @foreach($images as $image)
                                    @if($image->is_main && $image->avenue_id == $avenue->id)
                                    <a href="{{ route('show', $avenue->id) }}">
                                    <img class="img-fluid" loading="lazy" src="{{ asset('storage/' . $image->url) }}" alt="{{ $avenue->name }}">
                                    </a>
                                    @endif
                                    @endforeach
                                </a>
                            </figure>
                            <div class="card-body">
                                <div class="entry-header mb-3 text-center">
                                    <ul class="entry-meta list-unstyled d-flex justify-content-center mb-3">
                                        <li>
                                            <a class="d-inline-flex px-2 py-1 link-accent text-accent-emphasis bg-accent-subtle border border-accent-subtle rounded-2 text-decoration-none fs-7" href="#!">
                                                {{ $avenue->category ?? 'Classroom-based Lectures' }}
                                            </a>
                                        </li>
                                    </ul>
                                    <h2 class="card-title entry-title h4 m-0">
                                        <a class="link-dark text-decoration-none" href="{{route('show',$avenue->id)}}">{{ $avenue->name }}</a>
                                    </h2>
                                </div>
                                <div class="review-section">
                                    <p class="font-weight-bold mb-2">Review ({{ $avenue->reviews->count() }} reviews)</p>
                                    <div class="form-group">
                                        <div class="star-rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $avenue->averageRating)
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
                                        <strong>Capacity (People):</strong> {{ $avenue->size ?? "Not Found :(" }}
                                    </li>
                                    <div class="text-center mt-4">
                                    <a href="{{route('show',$avenue->id)}}">Read more</a>
                                    </div>
                                </ul>
                                <div class="text-center mt-4">
                                    <a class="btn btn-primary btn-lg rounded-pill" href="/Customer-Online-Avenue/booking/{{$avenue->id}}">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</div>
    </div>
</section>
@endsection
