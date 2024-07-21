@extends('Backend.app')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Owner</h6>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $owner->name }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $owner->email }}" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ $owner->phone }}" required>
                </div>
                <div class="form-group">
                    <label for="avenues">Avenues</label>
                    <input type="text" name="avenues" class="form-control" value="{{ $owner->avenues }}" required>
                </div>
                <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure you want to update this owner information?')" >Update Owner</button>
                <form action="show-owner/{{$owner->id}}/edit-owner" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this owner?')" class="btn btn-danger ">Delete Owner</button>
                </form>
            </form>
        </div>
    </div>
</div>
@endsection
