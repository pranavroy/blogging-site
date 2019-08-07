<?php
include("db.php");
require_once('vendor/autoload.php');
\Stripe\Stripe::setApiKey('sk_test_OpdXoM2MREPePxBpi4UCngqs00OFLimmen');
$POST=filter_var_array($_POST,FILTER_SANITIZE_STRING);
$first_name=$POST['first_name'];
$last_name=$POST['last_name'];
$email=$POST['email'];
$token=$POST['stripeToken'];
//create customer in stripe
$customer=\Stripe\Customer::create(array("email"=>$email,"source"=>$token));
//charge customer
$charge=\Stripe\Charge::create(array("amount"=>1000,"currency"=>"USD","description"=>"For signing up","customer"=>$customer->id));
$first_name=$POST['first_name'];
$last_name=$POST['last_name'];
$email=$POST['email'];
$transaction_id=$charge->id;
$amount=$charge->amount;
$payment_method=$charge->payment_method;
$currency=$charge->currency;
$status=$charge->status;
$sql = "INSERT INTO  transaction(first_name, last_name, email,gateway, transaction_id,amount,payment_method,currency,status) VALUES ('$first_name','$last_name','$email','stripe','$transaction_id','$amount','$payment_method','$currency','$status')";
$conn->exec($sql);



if ($charge->status=='succeeded') {
	echo "<script>
       alert('Successfully paid now you can signup');
           window.location.href='newuser_signup.php';
           </script>";
}
else{
	echo "<script>
       alert('Not paid again pay');
           window.location.href='newuser1_signup.php';
           </script>";
}

?>