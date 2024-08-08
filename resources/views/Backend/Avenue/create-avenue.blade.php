@extends('Backend.app')

@section('title', 'Hall plus - Create Avenue')

@section('content')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Avenue</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('createAvenue', $owner_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                </div>
              
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" id="location" name="location" required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="price" required >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="size">Capacity (People)</label>
                        <input type="number" class="form-control" id="size" name="size" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="image">main Image</label>
                    <input type="file" class="form-control" id="image" name="image" required>
                </div>
                <div class="form-group">
                    <label for="other_images">Other Images</label>
                    <input type="file" class="form-control" id="other_images" name="other_images[]" multiple accept="image/*">
                </div>
                <div class="form-group">
                    <label for="advantages">Avenue Features</label>
                    <div class="row">
                        @foreach($Avenueadvantages as $advantage)
                            <div class="col-md-2 Avenueadvantages-card">
                                <div class="card mb-1 fixed-card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $advantage->name }}</h5>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="avenueadvantages_{{ $advantage->id }}" name="avenueadvantages[]" value="{{ $advantage->id }}">
                                            <label class="form-check-label" for="avenueadvantages_{{ $advantage->id }}">
                                                Select
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button id="selectAllBtn" type="button" class="btn mb-2" style="color: green">Select All</button>
                </div>
                <div class="form-group">
                    <label for="notes">Additional Features</label>
                    <textarea class="form-control" id="notes" name="note" rows="4" ></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add Avenue</button>
            </form>
        </div>
    </div>
</div>

<style>
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
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllBtn = document.getElementById('selectAllBtn');
        const checkboxes = document.querySelectorAll('input[name="avenueadvantages[]"]');
        let isSelectAll = true;

        selectAllBtn.addEventListener('click', () => {
            checkboxes.forEach(checkbox => checkbox.checked = isSelectAll);
            selectAllBtn.textContent = isSelectAll ? 'Deselect All' : 'Select All';
            selectAllBtn.style.color = isSelectAll ? 'red' : 'green';
            isSelectAll = !isSelectAll;
        });
    });
document.getElementById('size').addEventListener('input', function() {
    var size = this.value;
    var price = size / 0.3;
    document.getElementById('price').value = price.toFixed(2); 
});
</script>

@endsection
