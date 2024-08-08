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
        <div class="container  py-3 py-md-5 py-xl-8 ">
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
                                    <label for="price" class="form-label">Avenue Price Per Day:</label>
                                    <input type="text" id="price" name="price" value="{{ $selectedAvenue->price_per_hours }}" class="form-control" readonly>
                                </div>
                              
                                <div class="form-group"> 
                                    <label for="start_date">Start Date</label> 
                                    <input type="date" class="form-control" id="start_date" name="start_date" required> 
                                </div> 
 
                                <div class="form-group"> 
                                    <label for="end_date">End Date</label> 
                                    <input type="date" class="form-control" id="end_date" name="end_date" required> 
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
<div class="card-body"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <script type="text/javascript"> 
        $(function() { 
            var dtToday = new Date(); 
            var month = dtToday.getMonth() + 1; 
            var day = dtToday.getDate(); 
            var year = dtToday.getFullYear(); 

            if (month < 10) month = '0' + month; 
            if (day < 10) day = '0' + day; 

            var maxDate = year + '-' + month + '-' + day; 
            $('#start_date').attr('min', maxDate); 
            $('#end_date').attr('min', maxDate); 
        }); 
    </script>
@endsection
