<!--
<!DOCTYPE html>
<html>
<head>
	<title>pay</title>
	 <link rel="stylesheet" href="style2.css">
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://js.braintreegateway.com/js/braintree-2.31.0.min.js"></script>
	<script>
	$.ajax({
	url:"token.php",
	type:"get",
	dataType:"json",
	success:function(data){
		braintree.setup(data,'dropin',{container:'dropin-container'});
}
})
</script>
	<style>
		.payment-form{
			width: 300px;
			margin-left: 500px;
			padding: 10px;
			border: 1px solid;
		}
	</style>
</head>
<body style="text-align: center;margin-top: 100px;">
	<form action="paymentbraintree.php" method="post" class="payment-form">
		First Name<input type="text" name="firstname" id="firstname"><br><br>
		Last Name<input type="text" name="lastname" id="lastname"><br><br>
		<div id="dropin-container"></div>
		<br><br>
		<button type="submit">Pay with braintree</button>

</body>
</html>
--->
<!DOCTYPE html>
<html>
<head>
	<title>pay</title>
	</head>
	<body>
<form id="checkout" method="post" action="paymentbraintree.php">

                <div class="container">
                <h4 class="bt_title">Credit Card Details</h4>
                <fieldset class="one_off_country">
                  <label class="input-label" for="country">
                  <span class="field-name">Card number</span>
                  <input id="card_number" name="card_number" class="input-field card-field" type="text" placeholder="Card number" autocomplete="off">
                  <div class="invalid-bottom-bar"></div>
                  </label>
                </fieldset>
                <fieldset class="one_off_country">
                  <label class="input-label" for="country">
                  <span class="field-name">CVV</span>
                  <input id="CVV" name="cvv" class="input-field card-field" type="text" placeholder="CVV" autocomplete="off">
                  <div class="invalid-bottom-bar"></div>
                  </label>
                </fieldset>
                <fieldset class="one_off_country">
                  <label class="input-label" for="country">
                  <span class="field-name">Expiration date (MM/YY)</span>
                  <input id="exp_date" name="exp_date" class="input-field card-field" type="text" placeholder="Expiration date (MM/YY)" autocomplete="off">
                  <div class="invalid-bottom-bar"></div>
                  </label>
                </fieldset>
                <fieldset class="one_off_country">
                  <input name="amount" value=10 type="hidden" />
                </fieldset>
                <div class="btn_container">
                  <input type="submit" name="make_payment" value="Make Payment" class="pay-btn">
                  <span class="loader_img"></span> </div>
                </div>
                  </form>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

              </body>
              </html>