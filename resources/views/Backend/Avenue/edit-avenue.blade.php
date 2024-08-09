@extends('Backend.app')

@section('title', 'Hall plus - Edit Avenue')

@section('content')
<style>
    .position-relative {
        position: relative;
    }

    .position-absolute {
        position: absolute;
    }

    .top-0 {
        top: 0;
    }

    .end-0 {
        right: 0;
    }

    .m-2 {
        margin: 0.5rem;
    }

    .p-1 {
        padding: 0.25rem;
    }

    .delete-btn {
        position: absolute;
        top: 0;
        right: 0;
        color: rgb(141, 49, 49);
        border: none;
        cursor: pointer;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .delete-btn:hover {
        background: darkred;
    }
</style>
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
                    <div class="form-group col-md-6">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $avenue->name) }}" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $avenue->location) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $avenue->price_per_hours) }}" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="size">Capacity (People)</label>
                        <input type="number" class="form-control" id="size" name="size" value="{{ old('size', $avenue->size) }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="images">Main Image</label>
                    <div class="form-group">
                        @foreach($images as $image)
                            @if($image->is_main)
                                <div class="me-4 mb-6 py-3 position-relative">
                                    <img src="{{ asset('storage/' . $image->url) }}" alt="Current Image" class="img-thumbnail" style="width:250px; height:200px;">
                                    <div class="mt-2">
                                        <input type="file" class="form-control" id="image" name="image" style="width:250px;">
                                    </div>
                                </div>
                            @endif
                        @endforeach

                        <label for="images">Other Images</label>
                        <div class="d-flex flex-wrap mb-6">
                            @foreach($images as $image)
                                @if(!$image->is_main)
                                    <div class="me-4 mb-6 position-relative">
                                        <img src="{{ asset('storage/' . $image->url) }}" alt="Current Image" class="img-thumbnail" style="width:250px; height:200px;">
                                        <input type="file" class="form-control" id="other_images" name="other_images[{{ $image->id }}]" style="width:250px;" value="{{ $image->id }}">
                                        <button type="button" class="delete-btn" onclick="deleteImage({{ $image->id }})">X</button>
                                        <input type="hidden" name="delete_image_ids[]" value="{{ $image->id }}">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <label for="advantages">Add New Features</label>
                <div class="row">
                    @foreach($Avenueadvantages as $advantage)
                    @if(!$avenue->avenueadvantage->contains($advantage->id))
                    <div class="col-md-2 Avenueadvantages-card">
                            <div class="card mb-1 fixed-card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $advantage->name }}</h5>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="addAdv{{ $advantage->id }}" name="addAdv[]" value="{{ $advantage->id }}">
                                        <label class="form-check-label" for="addAdv{{ $advantage->id }}">
                                            Select to add
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @endforeach
                    <button id="selectAllBtn" type="button" class="btn mb-2" style="color: green">Select All</button>
                </div>

                <label for="advantages">Remove Existing Features</label>
                <div class="row">
                    @foreach($avenue->avenueadvantage as $advantage)
                        <div class="col-md-2 Avenueadvantages-card">
                            <div class="card mb-1 fixed-card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $advantage->name }}</h5>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="removeAdv{{ $advantage->id }}" name="removeAdv[]" value="{{ $advantage->id }}">
                                        <label class="form-check-label" for="removeAdv{{ $advantage->id }}">
                                            Select to remove
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="form-group">
                    <label for="notes">Features Notes</label>
                    <textarea class="form-control" id="advantages" name="note" rows="4">{{ old('advantages', $avenue->advantages) }}</textarea>
                </div>

                <div class='d-flex'>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary me-2" onclick="return confirm('Are you sure you want to update this avenue?')">Update Avenue</button>
                    </div>
                </form>

                <form action="{{ route('deleteAvenue', $avenue->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this avenue?')">Delete Avenue</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
  


    document.addEventListener('DOMContentLoaded', function() {
        const selectAllBtn = document.getElementById('selectAllBtn');
        const checkboxes = document.querySelectorAll('input[name="addAdv[]"]');
        let isSelectAll = true;

        selectAllBtn.addEventListener('click', () => {
            checkboxes.forEach(checkbox => checkbox.checked = isSelectAll);
            selectAllBtn.textContent = isSelectAll ? 'Deselect All' : 'Select All';
            selectAllBtn.style.color = isSelectAll ? 'red' : 'green';
            isSelectAll = !isSelectAll;
        });

        document.getElementById('size').addEventListener('input', function() {
            var size = this.value;
            var price = size * 10 ;
            document.getElementById('price').value = price.toFixed(2);
        });
    });
</script>