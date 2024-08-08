@extends('Backend.app')
@section('title','Online Avenue - Avenues')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Avenues</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
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
                            <a href="/Admin-Online-Avenue/show-avenue/{{$avenue->id}}/edit-avenue" class="btn btn-primary btn-sm">Edit</a>
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
