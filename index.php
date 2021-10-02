<?php
// Include configuration file  
require_once 'src/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe</title>
    <script src="https://js.stripe.com/v3/"></script>
    <link rel="stylesheet" href="./src/boostrap/bootstrap.min.css">
    <script src="./src/boostrap/jquery-3.6.0.min.js"></script>
    <script src="./src/boostrap/popper.min.js"></script>
    <script src="./src/boostrap/bootstrap.min.js"></script>
    <style>
        .container {
            width: 500px;
            margin: 50px auto;
            padding: 30px 20px;
            background: #e3e3e3;
        }

        .title {
            font-size: 26px;
            font-weight: 600;
            margin-right: 10px;
        }

        .value {
            font-size: 25px;
        }
    </style>

</head>

<body>
    <div class="container">
        <p>
            <label for="" class="title">Product name:</label>
            <span class="value">product name</span>
        </p>
        <p>
            <label for="" class="title">Price:</label>
            <span class="value">100$</span>
        </p>
        <p>
            <label for="" class="title">Quantity:</label>
            <span class="value">1</span>
        </p>
        <button id="checkout">Checkout</button>
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <script>
        $('.spinner-border').hide();
        // Set your publishable API key
        var stripe = Stripe('<?php echo PUBLISHABLE_KEY?>');

        $(document).ready(function() {
            $('#checkout').on('click', function() {
                $('.spinner-border').show()
                let data = {
                    'chechout': true,
                    'name': 'product name',
                    'price': 100,
                }
                $.post('./src/payment.php', data, function(res) {
                    stripe.redirectToCheckout({
                        sessionId: res
                    })
                })
            })
        })
    </script>
</body>

</html>