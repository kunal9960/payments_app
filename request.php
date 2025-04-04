<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/vendor/autoload.php';

use PhonePe\Env;
use PhonePe\payments\v1\models\request\builders\InstrumentBuilder;
use PhonePe\payments\v1\models\request\builders\PgPayRequestBuilder;
use PhonePe\payments\v1\PhonePePaymentClient;

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    try {
        // Generate a unique order_id if not provided
        $order_id = $_POST['order_id'] ?? "order_" . uniqid();
        $order_amount = $_POST['order_amount'] * 100; // Convert to paisa
        $mobile_number = $_POST['mobileNumber'];
        $name = $_POST['user_name']; // Get the name from the form

        // ✅ Insert transaction into the database BEFORE processing payment
        $sql = "INSERT INTO transactions (order_id, name, mobile_number, amount, status) VALUES (?, ?, ?, ?, 'PENDING')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssd", $order_id, $name, $mobile_number, $_POST['order_amount']);
        $stmt->execute();

        // ✅ Now proceed with the PhonePe API payment request
        $phonePePaymentsClient = new PhonePePaymentClient(API_MERCHAT_ID, API_KEY, API_KEY_INDEX, ENV, true);
        
        $request = PgPayRequestBuilder::builder()
            ->mobileNumber($mobile_number)
            ->callbackUrl(WEBHOOK_PATH) 
            ->redirectUrl(RESPONSE_PATH . "?order_id=$order_id") 
            ->merchantId(API_MERCHAT_ID)
            ->amount($order_amount)
            ->merchantTransactionId($order_id)
            ->paymentInstrument(InstrumentBuilder::buildPayPageInstrument())
            ->build();

        $response = $phonePePaymentsClient->pay($request);
        $PagPageUrl = $response->getInstrumentResponse()->getRedirectInfo()->getUrl();
        
        echo "<script>location.href='".$PagPageUrl."';</script>";
        exit;   
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
        exit;
    }
} else {
    echo "<script>location.href='index.php';</script>";
}
?>
