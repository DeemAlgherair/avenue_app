<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="{{ asset('Backend/css/mail.css') }}">
<head>
    <title>Reset Password</title>
</head>
<body>
    <div class="container d-flex justify-content-between align-items-center">
        <div class="header">
            <h1>Hello, {{ $name }}</h1>
        </div>
        <div class="content">
            <p>It seems like you requested a password reset. Please click the button below to reset your password:</p>
            <a href="{{env('APP_URL')}}/reset-password-customer/{{ $token }}?email={{ $email }}"class="button" target="_blank">Reset Password</a>
            <p>If you did not request this, please ignore this email.</p>
            <p>Thank you!</p>
        </div>
    </div>
</body>
</html>
