<!DOCTYPE html>
<html>
<head>
    <title>Bank Transfer Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <h1>Bank Transfer Payment</h1>
    <form id="payment-form">
        <div id="bank-element"></div>
        <button type="submit">Pay Now</button>
    </form>

    <script>
        var stripe = Stripe('STRIPE_KEY'); // Replace with your Stripe public key
        var clientSecret = '{{ $clientSecret }}';

        var elements = stripe.elements();
        var bankElement = elements.create('sepaDebit');
        bankElement.mount('#bank-element');

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.confirmSepaDebitPayment(clientSecret, {
                payment_method: {
                    sepa_debit: bankElement,
                    billing_details: {
                        name: 'Customer Name'
                    }
                }
            }).then(function(result) {
                if (result.error) {
                    // Handle error here
                    console.error(result.error.message);
                } else {
                    if (result.paymentIntent.status === 'succeeded') {
                        window.location.href = "{{ route('payment.success', ['bookingId' => $booking->id]) }}";
                    }
                }
            });
        });
    </script>
</body>
</html>
