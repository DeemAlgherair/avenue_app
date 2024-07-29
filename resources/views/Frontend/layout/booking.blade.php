@extends('frontend.layout.app')

@section('content')

<body>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="bg-light py-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card border-light shadow-sm">
                        <!-- Card Header -->
                        <div class="card-header bg-primary text-light">
                            <h5 class="mb-0">Booking</h5>
                        </div>
                        <div class="card-body">       
                            <form method="POST" action="{{ route('bookings.store', ['avenueId' => $selectedAvenue->id]) }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Avenue Name:</label>
                                    <input type="text" id="name" name="name" value="{{ $selectedAvenue->name }}" class="form-control" readonly>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="location" class="form-label">Avenue Location:</label>
                                    <input type="text" id="location" name="location" value="{{ $selectedAvenue->location }}" class="form-control" readonly>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="price" class="form-label">Avenue Price Per Hour:</label>
                                    <input type="text" id="price" name="price" value="{{ $selectedAvenue->price_per_hours }}" class="form-control" readonly>
                                </div>
                              
                <label for="day_id">Available Days:</label>
    <select name="day_id" id="day_id">
        <option value="">Select a day</option>
        @foreach ($selectedAvenue->days as $availableDay)
            <option value="{{ $availableDay->id }}">
                {{ $availableDay->name }}
            </option>
        @endforeach
    </select>
                                <div class="mb-3">
                                    <label for="size" class="form-label">Number of Hours:</label>
                                    <input type="number" class="form-control" id="size" name="size" min="1" max="12" required>
                                </div>
 
                                <button type="submit" class="btn btn-primary">Book Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

</body>
@endsection
