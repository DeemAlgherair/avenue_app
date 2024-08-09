@extends('frontend.layout.app')
@section('content')
<link rel="stylesheet" href="{{ asset('Frontend/assets/css/allavenue.css') }}">

<section class="container py-5">
    <div class="row">
        <!-- Filter Button -->
        <div class="col-md-6 mb-4">
            <button class="btn btn-light w-50" id="filterToggle">
                <i class="fa fa-filter py-2" aria-hidden="true"></i> Filters
            </button>
            <div class="filter-card ">
                <div class="card-body-filter ">
                    <div class="collapse filter-card-coll" id="filterContent">
                        <form action="{{ route('filterAvenues') }}" method="GET" class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Location</label>
                                <!-- Location Checkboxes -->
                                @foreach(['Buraydah'] as $location)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="location[]" value="{{ $location }}" id="location{{ $location }}" 
                                            {{ in_array($location, request()->input('location', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="location{{ $location }}">
                                            {{ $location }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="col-12">
                                <label class="form-label">Capacity (People)</label>
                                <!-- Size Checkboxes -->
                                @foreach(['10-20', '20-50', '50-100', '100+'] as $size)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="size[]" value="{{ $size }}" id="size{{ $size }}" 
                                            {{ in_array($size, request()->input('size', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="size{{ $size }}">
                                            {{ $size }} people
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="col-12">
                                <label for="price" class="form-label">Max Price per Day</label>
                                <input type="number" name="price" id="price" class="form-control" placeholder="Enter max price" 
                                    value="{{ request()->input('price', '') }}">
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-light w-100">Apply Filters</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Avenues Listing -->
        <div class="col-md-12">
            <div class="row gy-4">
                @if($avenues->isEmpty())
                    <div class="col-12">
                        <p class="text-center">No Match Found</p>
                    </div>
                @else
                    @foreach ($avenues as $avenue)
                        <div class="col-12 col-md-6 col-lg-4">
                            <article>
                                <div class="card shadow">
                                    <figure class="card-img-top">
                                        @php
                                            // Retrieve the main image for the current avenue
                                            $mainImage = $images->filter(function($image) use ($avenue) {
                                                return $image->is_main && $image->avenue_id == $avenue->id;
                                            })->first();
                                        @endphp
                                        @if ($mainImage)
                                            <a href="{{ route('show', $avenue->id) }}">
                                                <img class="img-fluid d-block w-100" src="{{ asset('storage/' . $mainImage->url) }}" alt="{{ $avenue->name }}" style="height: 200px; object-fit: cover;">
                                            </a>
                                        @endif
                                    </figure>
                                    <div class="card-body">
                                        <div class="entry-header">
                                            <h2 class="entry-title">
                                                <a href="{{ route('show', $avenue->id) }}" class="text-dark">{{ $avenue->name }}</a>
                                            </h2>
                                        </div>
                                        <div class="review-section">
                                            <p class="font-weight-bold mb-2">Review ({{ $avenue->reviews->count() }} reviews)</p>
                                            <div class="star-rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $avenue->averageRating)
                                                        <span>★</span>
                                                    @else
                                                        <span style="color: #ccc;">★</span>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <strong>Location:</strong> {{ $avenue->location ?? "Not Found :(" }}
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Price per Day:</strong> {{ $avenue->price_per_hours ?? "Not Found :(" }}
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Capacity (People):</strong> {{ $avenue->size ?? "Not Found :(" }}
                                            </li>
                                        </ul>
                                        <ul class="entry-meta list-unstyled d-flex justify-content-center mt-4">
                                            <a class="btn btn-primary" href="{{ route('show', $avenue->id) }}">Read More</a>
                                        </ul>
                                        <ul class="entry-meta list-unstyled d-flex justify-content-center mt-4">
                                            <a class="btn btn-primary" href="/Customer-Online-Avenue/booking/{{$avenue->id}}">Book Now</a>
                                        </ul>
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('filterToggle').addEventListener('click', function () {
        var filterContent = document.getElementById('filterContent');
        if (filterContent.classList.contains('collapse')) {
            filterContent.classList.remove('collapse');
        } else {
            filterContent.classList.add('collapse');
        }
    });
</script>
@endsection
