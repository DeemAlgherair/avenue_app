<!DOCTYPE html>
<html>
<head>
    <title>Welcome To Hall Plus</title>
    <link rel="stylesheet" href="{{ asset('Backend/css/mail.css') }}">
</head>
<body>
<section class="body py-3 justify-content-center">
    <div class="container container1 justify-content-center">
        <div class="row justify-content-center">
            <div class="col-24 col-md-16 col-lg-12">
                <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                    <div class="card-body">
                        <h3 class="mb-6 text-center text-gray-900">Booking Approved</h3>
                        <h4 class="mb-6 text-center text-gray-900">We are pleased to inform you that your booking with us has been successfully approved!</h4>
                    </div>
                              
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
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

</body>
</html>
