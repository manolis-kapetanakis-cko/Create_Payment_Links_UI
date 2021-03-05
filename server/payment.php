<?php 
// Display errors if any
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Retrieve the token generate by Checkout.Frames and POSTED here.
$currency= $_POST['currency'];
$amount = $_POST['amount'];
$reference = $_POST['reference'];


$billing_country = $_POST['billing_country'];

$customer_name = $_POST['customer_name'];
$customer_email = $_POST['customer_email'];


// $product_name = $_POST['product_name'];
// $product_quantity = $_POST['product_quantity'];
// $product_price = $_POST['product_price'];

$expires_in = $_POST['expires_in'];
$return_url = $_POST['return_url'];

// The api endpoint and the authorisation key

$apiKey = "sk_test_07fa5e52-3971-4bab-ae6b-a8e26007fccc";  // Default channel

    $apiUrl = "https://api.sandbox.checkout.com/payment-links";
    // The request body that will be sent in the API call
    $requestBody = json_encode(array(
        'currency' => $currency,
        'amount' => intval($amount),
        'reference' => $reference,
        'billing'=>array(
            'address'=>array(
                'country'=> $billing_country
            )
        ),
        'customer'=>array(
            'name'=> $customer_name,
            'email'=> $customer_email
        ),
        // 'products'=>array(
        //     'name'=> $product_name,
        //     'quantity'=> $product_quantity,
        //     'price'=> $product_price
        // ),
        'expires_in' => intval($expires_in),
        'return_url' => $return_url
        )
    );



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$apiUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: '.$apiKey,
    'Content-Type:application/json;charset=UTF-8'
    ));
curl_setopt($ch, CURLOPT_POSTFIELDS, $requestBody);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);

$httpcode = curl_getinfo( $ch, CURLINFO_HTTP_CODE );

curl_close ($ch);

// The payment response
$response = json_decode($server_output);

if ( $httpcode !=201  ){
    echo(print_r($response->error_codes[0], true));
}
else{
    echo(print_r($response->_links->redirect->href, true));
}


exit();
?>