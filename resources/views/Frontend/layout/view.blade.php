


@extends('frontend.layout.app')
@section('title','HALL Plus')

@section('content')
<link rel="stylesheet" href="{{asset('Frontend/assets/css/avenue.css')}}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">

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
                                <a class="carousel-control-prev"href="#carouselExampleSlidesOnly" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleSlidesOnly" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                </a>
                            </div>
                            <!-- Carousel controls if needed -->
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
                                <strong>Capacity (People):</strong> {{ $avenue->size ?? "Not Found :(" }}
                            </li>
                            <li class="list-group-item py-3 mb-3">
                                <strong>Features:</strong>
                                <table cellpadding="5" cellspacing="0">
                                    @foreach($Avenueadvantages->chunk(3) as $chunk)
                                        <tr>
                                            @foreach($chunk as $advantage)
                                                <td class="custom-checkbox-wrapper">
                                                    @if($avenue->avenueadvantage->contains($advantage->id))
                                                        <span>✔</span>
                                                    @else
                                                        <span>✖</span>
                                                    @endif
                                                    <label>{{ $advantage->name }}</label>
                                                </td>
                                            @endforeach
                                            @for($i = count($chunk); $i < 3; $i++)
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
                        <ul class="entry-meta list-unstyled d-flex justify-content-center mt-4">
                            <a class="btn btn-primary btn-lg rounded-pill btn-book-now" href="/Customer-Online-Avenue/booking/{{$avenue->id}}">Book Now</a>
                        </ul>
                    </div>
                </div>

                <!-- Review Summary -->
                <div class="review-summary">
                    <div class="section-shadow mb-3">
                        <h4 class="mb-2 py-2">Customer Reviews</h4>
                    </div>
                        <div class="text-center mb-3">
                            <span class="star-rating justify-content-center">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $averageRating)
                                        <span class="star-rating-complete">★</span>
                                    @else
                                        <span class="star-rating-incomplete">★</span>
                                    @endif
                                @endfor
                            </span> 
                            ({{ round($averageRating, 1) }} / 5)
                        </div>
                    
                        @for ($i = 5; $i >= 1; $i--)
                            <div class="star-bar mb-2">
                                <span>{{ $i }} ★</span>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $totalReviews ? round(($reviewCounts[$i] / $totalReviews) * 100) : 0 }}%" aria-valuenow="{{ $reviewCounts[$i] }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span>{{ $totalReviews ? round(($reviewCounts[$i] / $totalReviews) * 100) : 0 }}%</span>
                            </div>
                        @endfor
                        
                    </div>
                    
                    <div class="comment-section " id="reviews-container">
                        <div class="review-sort mb-5">
                            <div class="container">
                                <div class="d-flex align-items-center">
                                <div class="dropdown-container">
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                            Sort <i class="fa fa-sort"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <div class="sort-options d-flex">
                                            <li><a href="{{ route('sortReviews', ['id' => $avenue->id, 'sort' => 'latest']) }}" tabindex="-1">Latest</a></li>
                                            <li><a href="{{ route('sortReviews', ['id' => $avenue->id, 'sort' => 'highest']) }}" tabindex="-1">Highest Rating</a></li>
                                            <li><a href="{{ route('sortReviews', ['id' => $avenue->id, 'sort' => 'lowest']) }}" tabindex="-1">Lowest Rating</a></li>
                                        </ul>
                                    </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
                    @foreach($reviews as $review)
                        <div class="comment mb-3">
                            <div class="comment-header">
                                
                                <img class="profile-pic" src="{{ asset('storage/' . $review->customer->profile_pic) }}" alt="{{ $review->customer->name }}'s Profile Picture">
                                <div>
                                    <div class="name">{{ $review->customer->name }}</div>
                                    <div class="review-location">{{ $review->customer->location }}</div>
                                </div>
                            </div>
                            <div class="star-rating mb-2" aria-label="Rating given by {{ $review->customer->name }}">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->rate)
                                        <span class="star-rating-complete">★</span>
                                    @else
                                        <span class="star-rating-incomplete">★</span>
                                    @endif
                                @endfor
                            </div>
                            <p class="comment-content">
                                {{ Str::limit($review->comment, 200) }}
                                @if (strlen($review->comment) > 200)
                                    <a href="#" class="text-primary show-more">Read more</a>
                                @endif
                            </p>
                            <p class="comment-date">posted at {{ $review->created_at->format('M d, Y') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script>


  // Read more/less functionality
  $('.show-more').on('click', function(e) {
    e.preventDefault();
    const commentContent = $(this).prev('.comment-content');
    if (commentContent.hasClass('expanded')) {
      commentContent.removeClass('expanded');
      $(this).text('Read more');
    } else {
      commentContent.addClass('expanded');
      $(this).text('Read less');
    }
  });

</script>

@endsection
