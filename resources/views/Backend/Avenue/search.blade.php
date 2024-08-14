@extends('Backend.app')
@section('title','Hall plus - Avenues')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Avenues</h6>
        </div>
        <div class="card-body">
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="GET" action="{{ route('searchAvenue') }}">
    <div class="input-group">
        <input type="text" name="query" class="form-control bg-light border-0 small" placeholder="Search for owner or avenue..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">
                <i class="fas fa-search fa-sm"></i>
            </button>
        </div>
    </div>
</form>

<br><br>
            <div class="table-responsive">
                <p></p>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Owner</th>
                            <th>Edit</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($avenues as $key => $avenue)
                        <tr>
                            <th scope="row">{{ ++$key }}</th>
                            <td>{{ $avenue->name }}</td>
                            <td>{{ $avenue->price_per_hours }}</td>
                     
                            <td> 
                            @if($avenue->owner)
                                <p>{{ $avenue->owner->name }}</p>
                            @else
                                <p>No owner assigned</p>
                            @endif</td>           
                           
                        <td>
                            <a href="/Admin-HALL-PLUS/show-avenue/{{$avenue->id}}/edit-avenue" class="btn btn-primary btn-sm">Edit</a>
                        </td>
                    </tr>

                        @endforeach
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
