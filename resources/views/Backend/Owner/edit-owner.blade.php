@extends('Backend.app')
@section('title', 'Hall plus- Edit Owner')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Owner</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('updateOwner', $owner->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $owner->name }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $owner->email }}" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $owner->phone }}" required>
                </div>

                <div class="form-group">
                    <label for="owned_avenues">Owned Avenues</label>
                    <div class="row">
                        @foreach($owner->avenues as $avenue)
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $avenue->name }}</h5>
                                        <a href="{{ route('updateAvenue', $avenue->id) }}" class="btn btn-link">
                                            Update this Avenue
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <label for="new_avenue">New Avenue</label>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <a href="{{ route('createAvenue', $owner->id) }}" class="btn btn-link">
                                        Add New Avenue
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class ='d-flex py-2'>
                <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to update this owner?')">Update Owner</button>
            </form>

            <form action="{{ route('deleteOwner', $owner->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this owner?')">Delete Owner</button>
            </form>
        </div>
    </div>
</div>
@endsection
