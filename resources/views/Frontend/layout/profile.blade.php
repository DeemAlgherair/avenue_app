@extends('frontend.layout.app')

@section('content')
<!-- Profile - Bootstrap Brain Component -->
<section class="bg-light py-3 py-md-5 py-xl-8">
    <div class="container">
        <div class="row">
            <div class="">
                <div class="card border-light shadow-sm">
                    <!-- Card Header -->
                    <div class="card-header bg-primary text-light">
                        <h5 class="mb-0">Profile</h5>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body ">
                        <form action="{{ route('updateProfile', $customer->id) }}" method="POST" enctype="multipart/form-data" class="row gy-3 gy-xxl-4">
                            @csrf
                            @method('PATCH')
                            
                            <div class="col-12">
                                <div class="row gy-2">
                                    <label class="col-12 form-label m-0">Profile Image</label>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            @if($customer->profile_pic)
                                            <div class="mb-3">
                                                <img src="{{ asset('storage/' . $customer->profile_pic) }}" alt="Current Image" class="img-thumbnail" style="max-width: 200px;">
                                            </div>
                                        @endif                
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Update Image</label>
                                        <input type="file" class="form-control" id="image" name="image" >
                                    </div>                                       
                               
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="inputName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="inputName" name="name" value="{{ $customer->name }}">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="inputPhone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="inputPhone" name="phone" value="{{ $customer->phone }}">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="inputEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="inputEmail" name="email" value="{{ $customer->email }}">
                            </div>

                            <div class="col-12 d-flex">

                                <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to update your profile ?')">Save Changes</button>
                        </form>
                        <form action="{{ route('deleteProfile', $customer->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete update your profile ?')">Delete </button>
                        </form>
                    </dic>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
