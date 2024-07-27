@extends('Backend.app')

@section('title', 'Online Avenue - Create Avenue')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Avenue</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('createAvenue') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="days">Days</label>
                    <div class="row">
                        @if($days->isEmpty())
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">No Days Available</h5>
                                </div>
                            </div>
                        </div>
                        @endif
                        @foreach($days as $day)
                                <div class="col-md-3">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $day->name }}</h5>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="day_{{ $day->id }}" name="days[]" value="{{ $day->id }}">
                                                <label class="form-check-label" for="day_{{ $day->id }}">
                                                    Select this day
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" id="location" name="location" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="size">Size (People)</label>
                        <input type="number" class="form-control" id="size" name="size" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" id="image" name="image" required>
                </div>
                <div class="form-group">
                    <label for="advantages">Advantages</label>
                    <textarea class="form-control" id="advantages" name="advantages" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add Avenue</button>
            </form>
        </div>
    </div>
</div>
@endsection
