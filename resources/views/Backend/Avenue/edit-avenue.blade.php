@extends('Backend.app')

@section('title', 'Hall Plus - Edit Avenue')

@section('content')

<link rel="stylesheet" href="{{asset('Backend/css/edit-avenue.css')}}">

<div class="container-fluid">
    <!-- Navigation Tabs -->

    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="edit-hall-tab" data-bs-toggle="tab" href="#edit-hall" role="tab" aria-controls="edit-hall" aria-selected="true">Edit Hall</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="edit-images-tab" data-bs-toggle="tab" href="#edit-images" role="tab" aria-controls="edit-images" aria-selected="true">Edit Hall Images</a>
        </li>
    </ul>
    <!-- Tab Content -->
    <div class="tab-content" id="myTabContent">
        <!-- Edit Hall Tab -->
        <div class="tab-pane fade show active" id="edit-hall" role="tabpanel" aria-labelledby="edit-hall-tab">
            <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Hall</h6>
                </div>
                <div class="card-body form-section">
                    <form id="updateForm" action="{{ route('updateAvenue', $avenue->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $avenue->name) }}" required>
                        </div>
                        
    
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $avenue->city) }}" required>
                            </div>
        
                            <div class="form-group col-md-3">
                                <label for="neighborhood">Neighborhood</label>
                                <input type="text" class="form-control" id="neighborhood" name="neighborhood" value="{{ old('neighborhood', $avenue->neighborhood) }}"  required>
                            </div>
        
                            <div class="form-group col-md-3">
                                <label for="street">Street</label>
                                <input type="text" class="form-control" id="street" name="street" value="{{ old('street', $avenue->street) }}"  required>
                            </div>
        
                            <div class="form-group col-md-3">
                                <label for="building_number">Building Number</label>
                                <input type="number" class="form-control" id="building_number" name="building_number" value="{{ old('building_number', $avenue->building_number) }}" >
                            </div>
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
                            </div>
                            <button id="selectAllBtn" type="button" class="btn mb-2 icon-btn" style="color: green">
                                <i class="fas fa-check-square"></i> Select All
                            </button>
                        </div>

                        <div class="form-group">
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
                        </div>

                        <div class="form-group">
                            <label for="notes">Features Notes</label>
                            <textarea class="form-control" id="advantages" name="note" rows="4">{{ old('advantages', $avenue->advantages) }}</textarea>
                        </div>
                        <div class ="d-flex">

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary icon-btn" onclick="return confirm('Are you sure you want to update this avenue?')">
                               Update 
                            </button>
                        </div>
                    </form>

                    <!-- Delete Avenue Form -->
                    <form  action="{{ route('deleteAvenue', $avenue->id) }}" method="POST" >
                        @csrf
                        @method('DELETE')
                        <button type="submit"  class="btn btn-danger icon-btn" onclick="return confirm('Are you sure you want to delete this avenue?')">
                         Delete </button>
                    </form>
                </div>

                </div>
            </div>
        </div>

        <!-- Edit Images Tab -->
    <div class="tab-pane fade" id="edit-images" role="tabpanel" aria-labelledby="edit-images-tab">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Images</h6>
                </div>
                <div class="card-body form-section">
                    <form action="{{ route('updateImage', $avenue->id) }}" method="POST" enctype="multipart/form-data" id="deleteForm">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="images">Main Image</label>
                            <div class="form-group">
                                @foreach($images as $image)
                                    @if($image->is_main)
                                        <div class="mb-3 position-relative">
                                            <img src="{{ asset('storage/' . $image->url) }}" alt="Current Image" class="img-thumbnail" style="width:250px; height:200px;">
                                            <input type="file" class="form-control mt-2" id="image" name="image" style="width:250px;">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <label for="images">Other Images</label>
                            <div class="d-flex flex-wrap mb-4">
                                  @foreach($images as $image)
                                      @if(!$image->is_main)
                                       <div class="position-relative me-3 mb-3">
                <img src="{{ asset('storage/' . $image->url) }}" alt="Current Image" class="img-thumbnail" style="width:250px; height:200px;">
                <input type="file" class="form-control mt-2" id="other_images" name="other_images[{{ $image->id }}]" style="width:250px;">
                <button type="button" class="delete-btn" onclick="deleteImage({{ $image->id }})">
                    X
                </button>
            </div>
        @endif
    @endforeach
</div>
                        <div class="form-group">
                            <label for="new_images">Add New Images</label>
                            <input type="file" class="form-control" id="new_images" name="new_images[]" multiple>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary icon-btn" onclick="return confirm('Are you sure you want to update these images?')">
                                <i class="fas fa-save"></i> Update Images
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



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
            var price = size * 10;
            document.getElementById('price').value = price.toFixed(2);
        });

    });
    document.addEventListener('DOMContentLoaded', function() {
    const editHallTab = document.getElementById('edit-hall-tab');
    const editImagesTab = document.getElementById('edit-images-tab');

    editHallTab.addEventListener('click', function () {
        document.getElementById('edit-hall').classList.add('show', 'active');
        document.getElementById('edit-images').classList.remove('show', 'active');
    });

    editImagesTab.addEventListener('click', function () {
        document.getElementById('edit-images').classList.add('show', 'active');
        document.getElementById('edit-hall').classList.remove('show', 'active');
    });
});
function deleteImage(imageId) {
    if (confirm('Are you sure you want to delete this image?')) {
        const form = document.getElementById('deleteForm');
        form.action = '/Admin-HALL-PLUS/delete-image/' + imageId;
        form.submit();
    }
}


</script>
@endsection
