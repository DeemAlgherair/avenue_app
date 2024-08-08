@extends('frontend.layout.app')

@section('content')
<style>
    .star-rating {
        font-size: 25px;
        text-align: left;
    }
    .star-rating-complete {
        color: #ffc700;
    }
    .star-rating-incomplete {
        color: #ccc;
    }
    .review-section {
        text-align: center;
    }
    .comment-section {
        margin-top: 30px;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    .comment {
        padding: 15px;
        border: 1px solid #e1e1e1;
        border-radius: 5px;
        background-color: #f9f9f9;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .comment-content {
        margin-bottom: 5px;
    }
    .comment-date {
        font-size: 0.9em;
        color: #777;
        text-align: left;
    }
    .profile-pic {
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }
    .comment-header {
        display: flex;
        align-items: center;
    }
    .comment-header img {
        margin-right: 15px;
    }
    .comment-header .name {
        font-weight: bold;
        font-size: 1.2em;
    }
    .review-summary {
        text-align: center;
        margin-top: 20px;
        margin-bottom: 30px;
    }
    .review-summary .star-bar {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    .review-summary .star-bar span {
        margin-left: 10px;
    }
    .review-summary .star-bar .progress {
        flex-grow: 1;
        margin: 0 10px;
        height: 10px;
    }
    .review-summary .progress-bar {
        background-color: #ffc700;
    }
    .review-and-comments {
        display: flex;
        gap: 20px;
    }
    .review-summary, .comment-section {
        flex: 1;
    }
    .btn-book-now {
        display: block;
        width: 100%;
        margin-top: 20px;
    }
    .card-header {
        background-color: #f8f9fa;
        padding: 20px;
    }
    .section-shadow {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 10px;
        border-radius: 5px;
        background-color: #fff;
    }
    .list-group-item {
        font-size: 17px;
        padding: 15px;
    }
    .list-group-item ul {
        list-style: none; /* Remove default list dots */
        padding-left: 0;
    }
    .list-group-item ul li {
        display: flex;
        align-items: center;
        padding: 5px 0;
    }
    .list-group-item ul li input[type="checkbox"] {
        margin-right: 10px;
    }
    .fixed-card {
        width: 180px;
        height: 100px;
        display: flex;
        justify-content: left;
        align-items: left;
        text-align: left;
    }
    .card-body {
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .custom-checkbox-wrapper input[type="checkbox"] {
    display: none;
}
</style>

<div class="container my-5">
    <div class="card shadow">
        <div class="card-body py-5">
            <div class="section-shadow">
                <h2 class="text-center mb-2 py-2">{{ $avenue->name ?? "Not Found :(" }}</h2>
            </div>

            <div class="container my-5">
                <div class="row">
                    <div class="col-md-6">
                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($images as $image)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <img class="d-block w-100" src="{{ asset('storage/' . $image->url) }}" alt="Avenue Image" style="height: 480px; object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                            <!-- Carousel controls -->
                            <a class="carousel-control-prev" href="#carouselExampleSlidesOnly" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only" style="color: rgb(255, 255, 255)"></span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleSlidesOnly" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only" style="color: rgb(255, 255, 255)"></span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong>Location:</strong> {{ $avenue->location ?? "Not Found :(" }}
                            </li>
                            <li class="list-group-item">
                                <strong>Price per Day:</strong> {{ $avenue->price_per_hours ?? "Not Found :(" }}
                            </li>
                            <li class="list-group-item">
                                <strong>Capacity(People):</strong> {{ $avenue->size ?? "Not Found :(" }}
                            </li>
                            <li class="list-group-item py-3 mb-3">
                                <strong>Features:</strong>
                                <table cellpadding="5" cellspacing="0" >
                                    @foreach($Avenueadvantages->chunk(3) as $chunk)
                                        <tr>
                                            @foreach($chunk as $advantage)
                                                <td class="custom-checkbox-wrapper">
                                                    @if($avenue->avenueadvantage->contains($advantage->id))
                                                        <span >✔</span>
                                                        <input type="checkbox" checked disabled >
                                                    @else
                                                        <span>❌</span>
                                                        <input type="checkbox" unchecked disabled>
                                                    @endif
                                                    <label>{{ $advantage->name }}</label>
                                                </td>
                                            @endforeach
                                            @for($i = count($chunk); $i < 4; $i++)
                                                <td></td> 
                                            @endfor
                                        </tr>
                                    @endforeach
                                </table>
                            </li>
                            
                            <li class="list-group-item">
                                <strong>Additional Features:</strong> {{ $avenue->advantages ?? "" }}
                            </li>
                         
                        </ul>
                        <div class="text-right mt-4 col-12">
                            <a class="btn btn-primary btn-lg rounded-pill btn-book-now" href="/Customer-Online-Avenue/booking/{{$avenue->id}}">Book Now</a>
                        </div>
                    </div>
                </div>

                <!-- Review Summary -->
                <div class="review-summary">
                    <div class="section-shadow mb-4">
                        <h4 class="mb-2 py-2">Customer Reviews</h4>
                    </div>
                    @for ($i = 5; $i >= 1; $i--)
                        <div class="star-bar">
                            <span>{{ $i }} ★</span>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: {{ $totalReviews ? round(($reviewCounts[$i] / $totalReviews) * 100) : 0 }}%" aria-valuenow="{{ $reviewCounts[$i] }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span>{{ $totalReviews ? round(($reviewCounts[$i] / $totalReviews) * 100) : 0 }}%</span>
                        </div>
                    @endfor
                </div>

                <!-- Comment Section -->
                <div class="comment-section">
                    @foreach($avenue->reviews as $review)
                        <div class="comment">
                            <div class="comment-header">
                                <img class="profile-pic" src="{{ asset('storage/' . $review->customer->profile_pic) }}" alt="{{ $review->customer->name }}'s Profile Picture">
                                <div class="name">{{ $review->customer->name }}</div>
                            </div>
                            <div class="star-rating" aria-label="Rating given by {{ $review->customer->name }}">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->rate)
                                        <span class="star-rating-complete">★</span>
                                    @else
                                        <span class="star-rating-incomplete">★</span>
                                    @endif
                                @endfor
                            </div>
                            <p class="comment-content">{{ $review->comment }}</p>
                            <p class="comment-date">posted at {{ $review->created_at->format('M d, Y') }}</p>
                        </div>
                    @endforeach
                </div>
                <!-- End Comment Section -->
            </div>
        </div>
    </div>
</div>

@endsection


