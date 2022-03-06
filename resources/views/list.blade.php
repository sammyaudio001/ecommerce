<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Tienda con Laravel V6</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="album.css">


    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

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

        .jumbotron {
            padding-top: 3rem;
            padding-bottom: 3rem;
            margin-bottom: 0;
            background-color: #fff;
        }

        @media (min-width: 768px) {
            .jumbotron {
                padding-top: 6rem;
                padding-bottom: 6rem;
            }
        }

        .jumbotron p:last-child {
            margin-bottom: 0;
        }

        .jumbotron h1 {
            font-weight: 300;
        }

        .jumbotron .container {
            max-width: 40rem;
        }

        footer {
            padding-top: 3rem;
            padding-bottom: 3rem;
        }

        footer p {
            margin-bottom: .25rem;
        }

    </style>


    <!-- Custom styles for this template -->
    <link href="album.css" rel="stylesheet">
</head>

<body>

    <header>
        <div class="collapse bg-dark" id="navbarHeader">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-7 py-4">
                        <h4 class="text-white">Sobre la tienda</h4>
                        <p class="text-muted">Tienda con integracion con los paquetes
                            Cashier y Stripe para carga de producto y pasarela de pagos.
                        </p>
                    </div>

                </div>
            </div>
        </div>
        <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container d-flex justify-content-between">
                <a href="#" class="navbar-brand d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true"
                        class="mr-2" viewBox="0 0 24 24" focusable="false">
                        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" />
                        <circle cx="12" cy="13" r="4" />
                    </svg>
                    <strong>Tienda</strong>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader"
                    aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </header>

    <main role="main">
        <section class="jumbotron text-center">
            <div class="container">
                <h1>Productos</h1>

            </div>
        </section>

        <div class="container">
            <div class="card" style="width: 18rem;">
                @foreach ($skus as $items)
                    <div class="card-body text-center">
                        <img src="https://images.unsplash.com/photo-1416339698674-4f118dd3388b?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1336&q=80" alt="..." style="width: 200px;">

                        <h5 class="card-title">{{ $items->name }}</h5>
                        <p class="card-text">{{ $items->description }}</p>
                        <button
        style="background-color:#6772E5;color:#FFF;padding:8px 12px;border:0;border-radius:4px;font-size:1em;cursor:pointer"
        id="checkout-button-price_1KaRozE6630G1WJD0psROqAR" role="link" type="button">
        Comprar
    </button>

           </div>
            </div>
        </div>
        @endforeach
    </main>


    <!-- Load Stripe.js on your website. -->
    <script src="https://js.stripe.com/v3"></script>

    <!-- Create a button that your customers click to complete their purchase. Customize the styling to suit your branding. -->

    <div id="error-message"></div>

    <script>
        (function() {
            var stripe = Stripe(
                'pk_test_51HaOdgE6630G1WJDqWXCfxG7YxZRg041vmdpbQTN70mX6lKx8oCvOSPki5AtyoiJ380x6GglTwAgSCgrQC8WIt3Q00XGgDbIvu'
                );

            var checkoutButton = document.getElementById('checkout-button-price_1KaRozE6630G1WJD0psROqAR');
            checkoutButton.addEventListener('click', function() {
                /*
                 * When the customer clicks on the button, redirect
                 * them to Checkout.
                 */
                stripe.redirectToCheckout({
                        lineItems: [{
                            price: 'price_1KaRozE6630G1WJD0psROqAR',
                            quantity: 1
                        }],
                        mode: 'payment',
                        /*
                         * Do not rely on the redirect to the successUrl for fulfilling
                         * purchases, customers may not always reach the success_url after
                         * a successful payment.
                         * Instead use one of the strategies described in
                         * https://stripe.com/docs/payments/checkout/fulfill-orders
                         */
                        successUrl: 'https://example.com/success',
                        cancelUrl: 'https://example.com/canceled',
                    })
                    .then(function(result) {
                        if (result.error) {
                            /*
                             * If `redirectToCheckout` fails due to a browser or network
                             * error, display the localized error message to your customer.
                             */
                            var displayError = document.getElementById('error-message');
                            displayError.textContent = result.error.message;
                        }
                    });
            });
        })();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
        integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous">
    </script>
</body>

</html>
