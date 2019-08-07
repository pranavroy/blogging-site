<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width">
    <title>pay first</title>
</head>
<body>
    <div class="container">
        <h2 class="my-4 text-center">For Signup first pay 10$</h2>
        <p>Pay by any means</p>
<input type="radio" name="tab" value="igotnone" onclick="show1();" />
Stripe
<input type="radio" name="tab" value="igottwo" onclick="show2();" />
Razorpay
<div id="div1" class="hide">
  
</div>
<form action="charge.php" method="post" id="payment-form">
  <div class="form-row">
    <input type="text" name="first_name"class="form-control mb-3 StripeElement StripeElement--empty" placeholder="First Name">
    <input type="text" name="last_name"class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Last Name">
    <input type="email" name="email"class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Email">
    <div id="card-element" class="form-control">
      <!-- A Stripe Element will be inserted here. -->
    </div>

    <!-- Used to display form errors. -->
    <div id="card-errors" role="alert"></div>
  </div>

  <button>Submit Payment</button>
</form><br><br>
<form action="charge2.php" method="post">
<script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="rzp_test_6GLgtUqEFNmlYA" // Enter the Key ID generated from the Dashboard
    data-amount="70000" // Amount is in currency subunits. Default currency is INR. Hence, 29935 refers to 29935 paise or INR 299.35.
    data-currency="INR"
    data-buttontext="Pay with Razorpay"
    data-name="Blogging"
    data-description="For signing Up"
    data-theme.color="#F37254"
></script>
<input type="hidden" custom="Hidden Element" name="hidden">
</form><br><br>
<a href="braintree_setup.php">Pay with braintree</a>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="charge.js"></script>
</body>
</html>