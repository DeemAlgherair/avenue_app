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

    <section class="bg-light py-3 py-md-5 py-xl-8">
    <div class="container">
        <div class="row">
            <div class="">
                <div class="card border-light shadow-sm">
                    <!-- Card Header -->
                    <div class="card-header bg-primary text-light">
                        <h5 class="mb-0">Booking</h5>
                    </div>
            <div class="card-body">       
                <form method="POST" action="{{ route('bookings.store' , ['avenueId' => $selectedAvenue->id])}}">
                    @csrf
                    <div class="form-group">
                    <label for="name">Avenue Name:</label>
                    <input type="text" id="name" name="name" value="{{ $selectedAvenue->name }}" readonly> 
                    </div>
                    
                    <div class="form-group">
                    <label for="name">Avenue Location:</label>
                    <input type="text" id="name" name="name:" value="{{ $selectedAvenue->location }}" readonly> </div>
                    
                    <div class="form-group">
                    <label for="name">Avenue Price Per hour:</label>
                    <input type="text" id="name" name="name" value="{{ $selectedAvenue->price_per_hours }}" readonly> </div>
                    
                    <label for="day_id">Available Days:</label>
    <select name="day_id" id="day_id">
        <option value="">Select a day</option>
        @foreach ($availableDays as $availableDay)
            <option value="{{ $availableDay->id }}">
                {{ $availableDay->name }}
            </option>
        @endforeach
    </select>
    <div class="form-group col-md-6">
                        <label for="size">Noumber of hours:</label>
                        <input type="number" class="form-control" id="size" name="size" min="1" max="12" required>
                    </div>
 
                <button type="submit" class="btn btn-primary">Book Now</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
@endsection