<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Stripe Embedded Checkout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        /* Add some basic styling for the checkout form */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f6f9fc;
        }
        #checkout {
            width: 100%;
            max-width: 500px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

    <div id="checkout">
        <!-- Stripe's embedded form will be mounted here -->
    </div>

    <script>
        const stripe = Stripe("{{ config('stripe.stripe_publishable') }}");

        // The book ID that is passed from the route
        const orderId = {{ $orderId }}; // You need to get this dynamically from your route

        // Initialize the embedded checkout form
        async function initialize() {
            // Function to fetch the client secret from our Laravel backend
            const fetchClientSecret = async () => {
                const response = await fetch(`/api/testPayment/${orderId}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({}) // Send an empty object if no data is needed
                });
                const { clientSecret } = await response.json();
                return clientSecret;
            };

            const checkout = await stripe.initEmbeddedCheckout({
                fetchClientSecret,
            });

            // Mount Checkout to the DOM element
            checkout.mount('#checkout');
        }

        initialize();
    </script>
</body>
</html>