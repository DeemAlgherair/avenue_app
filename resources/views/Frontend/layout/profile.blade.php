@extends('frontend.layout.app')
@section('title', 'Online Avenue - Profile')
@section('content')

<div class=" container-fluid  py-3 py-md-5 py-xl-8 ">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-light">
                    <h5 class="font-weight-bold" >Edit Profile</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-xl-3 order-0 order-xl-0">
                            <div class="card shadow mb-4">
                                <div class="card-body text-center">
                                    <form action="{{ route('updateProfile', $customer->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <img class="img-profile rounded-circle mb-4" style="width:150px; height:150px;" src="{{ asset('storage/' . $customer->profile_pic) }}" alt="Profile Image">
                                        <div class="actions mt-4">
                                            <label class="btn btn-secondary">
                                                <input type="file" id="image" name="image" hidden>
                                                Change Profile Picture
                                            </label>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                      
                                <div class="form-group">
                                    <label for="customerName" >Name</label>
                                    <input type="text" class="form-control" id="customerName" name="name" value="{{ $customer->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="customerEmail">Email</label>
                                    <input type="email" class="form-control" id="customerEmail" name="email" value="{{ $customer->email }}">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                                <div class="form-group">
                                    <label for="customerPhone">Phone</label>
                                    <input type="phone" class="form-control" id="phone" name="phone" value="{{ $customer->phone }}">
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
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
                                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
