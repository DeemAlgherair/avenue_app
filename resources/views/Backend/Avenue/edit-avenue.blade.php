@extends('Backend.app')

@section('title', 'Online Avenue - Edit Avenue')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Avenue</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('updateAvenue', $avenue->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $avenue->name) }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="addDays">Add Days</label>
                    <div class="row">
                        @foreach($allDays as $day)
                            @if(!in_array($day->id, $selectedDays))
                                <div class="col-md-3">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $day->name }}</h5>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="add_day_{{ $day->id }}" name="addDays[]" value="{{ $day->id }}">
                                                <label class="form-check-label" for="add_day_{{ $day->id }}">
                                                    Select this day to add
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <label for="removeDays">Remove Days</label>
                    <div class="row">
                        @foreach($allDays as $day)
                            @if(in_array($day->id, $selectedDays))
                                <div class="col-md-3">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $day->name }}</h5>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="remove_day_{{ $day->id }}" name="removeDays[]" value="{{ $day->id }}">
                                                <label class="form-check-label" for="remove_day_{{ $day->id }}">
                                                    Select this day to remove
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $avenue->location) }}" required>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $avenue->price_per_hours) }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="size">Size (People)</label>
                        <input type="number" class="form-control" id="size" name="size" value="{{ old('size', $avenue->size) }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="image">Current Image</label>
                    @if($avenue->image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $avenue->image->url) }}" alt="Current Image" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    @endif                
                </div>

                <div class="form-group">
                    <label for="image">Update Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>

                <div class="form-group">
                 

                    <div class="form-group">
                        <label for="advantages">Advantages</label>
                        <textarea class="form-control" id="advantages" name="advantages" rows="4" required>{{ old('advantages', $avenue->advantages) }}</textarea>
                    </div>
    
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to update this avenue?')">Update Avenue</button>
                </form>
    
                <form action="{{ route('deleteAvenue', $avenue->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this avenue?')">Delete Avenue</button>
                </form>
            </div>
        </div>
    </div>
@endsection
