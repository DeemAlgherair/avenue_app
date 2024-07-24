<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title','Online Avenue')</title>


        <!-- Custom fonts for this template-->
        <link href="{{ asset('Backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
    
     
        <!-- Custom styles for this template-->
        <link href="{{ asset('Backend/css/sb-admin-2.min.css') }} "rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js" integrity="sha512-F636MAkMAhtTplahL9F6KmTfxTmYcAcjcCkyu0f0voT3N/6vzAuJ4Num55a0gEJ+hRLHhdz3vDvZpf6kqgEa5w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css" integrity="sha512-9tISBnhZjiw7MV4a1gbemtB9tmPcoJ7ahj8QWIc0daBCdvlKjEA48oLlo6zALYm3037tPYYulT0YQyJIJJoyMQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="bg-gradient-primary">
 

    @yield('content')

 
  <!-- Bootstrap core JavaScript-->

  <script src=" {{asset('Backend/vendor/jquery/jquery.min.js') }}"></script>
  <script src= "{{asset('Backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}  "
  ></script>

  <!-- Core plugin JavaScript-->

  <script src="{{asset('Backend/vendor/jquery-easing/jquery.easing.min.js') }}   "   ></script>


    <!-- Custom scripts for all pages-->
    <script src=" {{asset('Backend/js/sb-admin-2.min.js')}}"></script>

</body>

</html>