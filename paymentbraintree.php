<!--<? //php
//require"boot.php";
//if (empty($_POST['payment_method_nonce'])) {
	//header('Location:newuser1_signup.php');
}
//$result=Braintree_Transaction::sale(array(
     //  'amount'=>10,
     //  'payment_Method_Nonce'=>$_POST['payment_method_nonce'],
       //'customer'=>array('firstname'=>$_POST['firstname'],
        //            'lastname'=>$_POST['lastname']),
       //'options'=>['submitForSettlement'=>true]
));
//if ($result->success===true) {
	
//}else{
//	print_r($result->errors);
//	die();
}
?>

-->
<? php
 require 'vendor/braintree/braintree_php/lib/Braintree.php';

        $params = array(
            "testmode"   => "on",
            "merchantid" => "b5qn3z92n7k462yx",
            "publickey"  => "h765tf8mpcyyx8jv",
            "privatekey" => "725387cfb9cbdc28341ac9a3fb2faff1",
        );

        if ($params['testmode'] == "on") {
            Braintree_Configuration::environment('sandbox');
        } else {
            Braintree_Configuration::environment('production');
        }

        Braintree_Configuration::merchantId($params["merchantid"]);
        Braintree_Configuration::publicKey($params["publickey"]);
        Braintree_Configuration::privateKey($params["privatekey"]);
        // Customer details
       // $customer_firstname   = $_POST['name'];
        //$customer_email       = $_POST['email'];
        //$customer_phonenumber = $_POST['phone'];

        // Credit Card Details
        $card_number = $_POST['card_number'];
        $cvv         = $_POST['cvv'];
        $exp_date    = explode("/", $_POST['exp_date']);
        // EOF Credit Card Details

        // Create customer in braintree Vault
        $result = Braintree_Customer::create(array(
            'creditCard' => array(
                'number'          => $card_number,
                'expirationMonth' => $exp_date[0],
                'expirationYear'  => $exp_date[1],
                'cvv'             => $cvv,
            )
        ));

        if ($result->success) {
            // Save this Braintree_cust_id in DB and use for future transactions too
            $braintree_cust_id = $result->customer->id;
        } else {
            die("Error : " . $result->message);
        }
        // EOF Create customer in braintree Vault

        $sale = array(
            'customerId' => $braintree_cust_id,
            'amount'   => 10,
            'options' => array('submitForSettlement'   => true)
        );

        $result = Braintree_Transaction::sale($sale);

        if ($result->success) {
            // Execute on payment success event at here
            echo "success";
        } else {
            echo "Error : " . $result->_attributes['message'];
        }
   
?>
