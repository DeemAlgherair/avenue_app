@extends('Backend.app')

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
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="avenue_ids">Available Avenues</label>
                    <div class="row">
                        @if($avenues->isEmpty())
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">No Avenues Available</h5>
                                </div>
                            </div>
                        </div>
                        @endif
                        @foreach($avenues as $avenue)
                                <div class="col-md-4">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $avenue->name }}</h5>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="avenue_{{ $avenue->id }}" name="avenue_ids[]" value="{{ $avenue->id }}">
                                                <label class="form-check-label" for="avenue_{{ $avenue->id }}">
                                                    Select this avenue
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Add Owner</button>
            </form>
        </div>
    </div>
</div>
@endsection
