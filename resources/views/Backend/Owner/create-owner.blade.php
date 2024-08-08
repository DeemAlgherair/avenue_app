

@extends('Backend.app')
@section('title','Online Avenue - Create Owner')
@section('content')



<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Owner</h6>
        </div>
        <div class="card-body">
            <form action="{{route('createOwner')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required  value="{{old('name')}}">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />

                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required  value="{{old('email')}}">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" required value="{{old('phone')}}">
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />

                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Add Owner</button>
                    <div class="row">
            </form>
        </div>
    </div>
</div>
@endsection
