<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <meta http-equiv="Content-Security-Policy"
        content="default-src *; style-src 'self' 'unsafe-inline'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://js.stripe.com/v3/ ">

    <title>Checkout || {{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap core CSS -->

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

    <script src="https://js.stripe.com/v3/"></script>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Custom styles for this template -->
</head>

<body class="bg-light" id="app">
    <div class="container">
        <div class="py-5 text-center">
            @if(session('success') || session('error') || count($errors) > 0)
            <div class="container my-5">
                @include('layouts/messages')
            </div>
            @endif
            <h2>Checkout form</h2>
            <p class="lead">Please fill out the form below to complete your order. Your payment details are stored
                securedly.</p>
        </div>

        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your invoice</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Service name</h6>
                            <small class="text-muted">Checkup</small>
                        </div>
                        <span class="text-muted">{{$appointment->price}}</span>
                    </li>



                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong>{{$appointment->price}}</strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <form action="{{action("HomeController@checkout")}}" id="payment-form" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="card-element">
                            Credit or debit card
                        </label>
                        <div id="card-element">
                            <!-- A Stripe Element will be inserted here. -->
                        </div>
                        <input type="hidden" name="appointmentId" value="{{$appointment->id}}">
                        <!-- Used to display form errors. -->
                        <div id="card-errors" role="alert"></div>
                    </div>
                    <button class="btn btn-primary btn-lg btn-block">Submit Payment</button>
                </form>
            </div>
        </div>

        <div class="justify-content-center">
            <a href="/" class="btn btn-link">Continue shopping</a>
        </div>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">&copy; 2017-2020</p>
        </footer>
    </div>

    <script>
        (function() {
            // Create a Stripe client.
            var stripe = Stripe('pk_test_51Jer1GE4Pp7fIVq8hKcFUbOSMHopQofppEtN7TD3KmpiYZ0UrpRBbov5iFC3RZVb6iAq4Qq77aOcoTUB0nOs2TjV00e9Uz59w6');
            
            // Create an instance of Elements.
            var elements = stripe.elements();
        
            var style = {
            base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
            color: '#aab7c4'
            }
            },
            invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
            }
            };

            // Create an instance of the card Element.
            var card = elements.create('card', {
                style: style,
                hidePostalCode: true,
            });
            
            // Add an instance of the card Element into the `card-element` <div>.
                card.mount('#card-element');
            
                // Handle real-time validation errors from the card Element.
                card.on('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                displayError.textContent = event.error.message;
                } else {
                displayError.textContent = '';
                }
                });
            
                // Handle form submission.
                var form = document.getElementById('payment-form');
                form.addEventListener('submit', function(event) {
                event.preventDefault();
            
                stripe.createToken(card).then(function(result) {
                if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
                } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
                }
                });
                });
            
                // Submit the form with the token ID.
                function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);
            
                // Submit the form
                form.submit();
                }
        }) ();
    </script>
</body>

</html>