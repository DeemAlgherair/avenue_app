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
                                    </div>
                                    <div class="form-group position-relative">
                                        @if($customer->profile_pic)
                                            <div class="mb-3 position-relative">
                                                <img src="{{ asset('storage/' . $customer->profile_pic) }}" alt="Current Image" class="img-thumbnail" style="max-width: 200px;">
                                                <label for="image-upload" class="upload-icon position-absolute d-flex align-items-center justify-content-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                                                        <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z"/>
                                                    </svg>
                                                </label>
                                                  <input type="file" class="form-control d-none" id="image-upload" name="image">
                                            </div>
                                        @endif
                                    </div>
                                    
                            <div class="col-12 col-md-6 py-3">
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
