<!DOCTYPE html>
<html>
<head>
    <title>Welcome To Hall Plus</title>
    <link rel="stylesheet" href="{{ asset('Backend/css/mail.css') }}">
</head>
<body>
    <div class="container d-flex justify-content-between align-items-center ">
        <a class="navbar-brand" href="{{route('home')}}">
            <img src="{{asset('/Frontend/assets/img/logo.png')}}" alt="Hall Plus Logo">
        </a>

        <!-- Greeting and Message -->
        <h1>Hello, {{ $user->name }}</h1>
        <p>Thank you for registering with Hall Plus!</p>
    </div>
</body>
</html>
