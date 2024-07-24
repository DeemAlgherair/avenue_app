@extends('Backend.app')
@section('title', 'Online Avenue - Edit Avenue')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Avenue</h6>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $avenue->name }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="day">Day</label>
                        <select class="form-control" id="day" name="day" required>
                                <option value="{{ $avenue->days->id }}" {{ $avenue->avenue_day_id == $avenue->days->id ? 'selected' : '' }}>
                                    {{ $avenue->days->name }}
                                </option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" id="location" name="location" value="{{ $avenue->location }}" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ $avenue->price_per_hours }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="size">Size (People)</label>
                        <input type="number" class="form-control" id="size" name="size" value="{{ $avenue->size }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    @if($avenue->image_id)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $avenue->image->url) }}" alt="Current Image" class="img-thumbnail" style="max-width: 200px;">
                    </div>
                @endif                
            </div>
            <div class="form-group">
                <label for="image">Update Image</label>
                <input type="file" class="form-control" id="image" name="image" >
            </div>
                <div class="form-group">
                    <label for="advantages">Advantages</label>
                    <textarea class="form-control" id="advantages" name="advantages" rows="4" required>{{ $avenue->advantages }}</textarea>
                </div>
                    <div class="d-flex">

                  <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to update this avenue?')">Update Avenue</button>
                    </form>
                    <form action="{{ route('deleteAvenue', $avenue->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this owner?')">Delete Avenue</button>
                    </form>
        </div>
    </div>
</div>
@endsection


