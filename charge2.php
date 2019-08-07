<?php
include("db.php");
$transaction_id=$_POST['razorpay_payment_id'];
$amount=700;
$sql = "INSERT INTO  transaction(gateway, transaction_id,amount,currency,status) VALUES ('razorpay','$transaction_id','$amount','INR','Success')";
$conn->exec($sql);
echo "<script>
       alert('Successfully paid now you can signup');
           window.location.href='newuser_signup.php';
           </script>";
die;
?>