@extends('Backend.Auth.main')
@section('title', 'Hall Plus - Booking Approved')
@section('content')

<body class="bg-gradient-primary">

    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-7">
                        <div class="p-5 d-flex flex-column">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-2">Booking Approved</h1>
                                <p class="mb-4">We are pleased to inform you that your booking with us has been successfully approved!</p>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Message</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                            Dear {{ $customerName }},<br><br>
            We are pleased to inform you that your booking (Order Number: {{ $bookingId }}) with us has been successfully approved!<br><br>
            To complete your reservation, please proceed with the payment at your earliest convenience. Please note that you have until {{ $paymentDeadline }} to make the payment.<br><br>
            You can view and manage your booking details using the link below:<br><br>
            <a href="{{ $bookingDetailsUrl }}" class="btn btn-primary">View Booking Details</a><br><br>
            If you have any questions or need further assistance, feel free to contact us.<br><br>
            Thank you for choosing us!<br><br>
            Best regards,<br>
            The Hull Plus Team
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="text-center mt-4">
                                <a class="btn btn-primary" href="{{ route('payment.show',$id)}} ">Go to Pay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection