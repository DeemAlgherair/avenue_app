@extends('frontend.layout.app')
@section('content')
<body>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>
<section>
<div class="container"> 
  <div class="card">
     <div class="card-header  d-flex justify-content-between lign-items-center" >
           <h2 > Login </h2>
       </div>
           <div class="card-body">
              <form method ="POST" action="\login">
              @csrf
             <h2><label for="exampleInputEmail1">Email address</label></h2>
            <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email">
         <div class="form-group">
          <h2><label for="exampleInputPassword1">Password</label></h2>
          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
         </div>

         <div class="container mt-5 d-flex justify-content-between">
          <div class="containercontainer mt-5  justify-content-right">
            <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
         </div>
 </div>
 </div>
 </div>
</section>
@endsection()
