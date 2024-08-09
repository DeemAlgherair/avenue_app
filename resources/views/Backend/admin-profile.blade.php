@extends('Backend.app')
@section('title','Hall plus - Show Owner')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header text-left">
            <h6 class="font-weight-bold text-primary">Edit Profile</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow mb-4">
                        <div class="card-body text-center">
                            <form action="{{route('adminUpdateProfile')}}" method="POST"  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                            <img class="img-profile rounded-circle mb-4" style="width:150px; height:150px;" src="{{ asset('storage/' . $admin->profile_pic) }}" alt="Admin Image">
                            <div class="actions mt-4">
                                <input type="file" class="btn btn-secondary" id="image" name="image" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                        <div class="form-group">
                            <label for="adminName">Name</label>
                            <input type="text" class="form-control" id="adminName" name="name" value="{{$admin->name}}">
                        </div>
                        <div class="form-group">
                            <label for="adminEmail">Email</label>
                            <input type="email" class="form-control" id="adminEmail" name="email" value="{{$admin->email}}">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <label for="adminPassword">New Password</label>
                            <input type="password" class="form-control" id="adminPassword" name="password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div class="form-group">
                            <label for="adminPasswordConfirm">Confirm New Password</label>
                            <input type="password" class="form-control" id="adminPasswordConfirm" name="password_confirmation">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                        <div class="actions mt-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection