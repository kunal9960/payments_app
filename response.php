<?php
require_once __DIR__ . '/../config.php';
date_default_timezone_set("Asia/Kolkata");
require_once __DIR__ . '/vendor/autoload.php';
error_reporting(0);

use PhonePe\Env;
use PhonePe\payments\v1\PhonePePaymentClient;

try {
    if (empty($_GET['order_id'])) {
        echo "No Transaction Id Found in URL";
        exit;
    }

    $phonePePaymentsClient = new PhonePePaymentClient(API_MERCHAT_ID, API_KEY, API_KEY_INDEX, ENV, true);
    $order_id = $_GET['order_id'];
    $checkStatus = $phonePePaymentsClient->statusCheck($order_id);

    $order_status = $checkStatus->getState();
    $transaction_id = $checkStatus->getTransactionId();
    $order_amount = $checkStatus->getAmount() / 100; // Convert to INR

    // Check if the transaction already exists in the database
    $check_sql = "SELECT name FROM transactions WHERE order_id = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("s", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $customer_name = $row['name']; // Fetch the name

    if ($result->num_rows === 0) {
        // Insert new transaction
        $insert_sql = "INSERT INTO transactions (order_id, transaction_id, amount, status, created_at) 
                       VALUES (?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("ssds", $order_id, $transaction_id, $order_amount, $order_status);
        $stmt->execute();
    } else {
        // Update the existing transaction status
        $update_sql = "UPDATE transactions SET status = ?, transaction_id = ? WHERE order_id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("sss", $order_status, $transaction_id, $order_id);
        $stmt->execute();
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Status</title>
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/584/584052.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
body {
    background: url('https://raw.githubusercontent.com/kunal9960/payments_app/refs/heads/master/Source/Payments%20Thank%20you.png') no-repeat center center fixed;
    background-size: cover;
    backdrop-filter: blur(0.2px);
}
</style>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class='d-flex justify-content-center align-items-center'>
                <img src="https://raw.githubusercontent.com/kunal9960/payments_app/refs/heads/master/Source/checkmark-transparent.gif" alt="Processing..." width="40" class="me-2">
                <h5 class="text-center text-white mt-2">Payment Process Completed</h5>
            </div>
            <div class="col-md-6 mt-4">
                <div class="card" style="border: 3.5px solid #5F259F; border-radius: 15px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);">
                    <div class="card-body">
                        <h3 class="text-center" style="color: #5F259F;"><b><u>Order Payment Details</u></b></h3>
                        
                        <div class='row'>
                            <div class="mb-3 col-md-6">
                                <label for="customer_name" class="form-label">Customer Name</label>
                                <input type="text" class="form-control" value="<?= htmlspecialchars($customer_name) ?>" readonly>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="order_status" class="form-label">Order Status</label>
                                <input type="text" class="form-control" value="<?= $order_status ?>" readonly>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="order_id" class="form-label">Order ID</label>
                                <input type="text" class="form-control" value="<?= $order_id ?>" readonly>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="transaction_id" class="form-label">Transaction ID</label>
                                <input type="text" class="form-control" value="<?= $transaction_id ?>" readonly>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="order_amount" class="form-label">Order Amount</label>
                                <input type="text" class="form-control" value="<?= number_format($order_amount, 2) ?> INR" readonly>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="created_at" class="form-label">Transaction Time</label>
                                <input type="text" class="form-control" value="<?= date('Y-m-d H:i:s') ?>" readonly>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- View Transactions Button -->
    <div class="text-center mt-3">
        <a href="transactions.php" class="btn" 
            style="background-color: #5F259F; color: white; font-weight: bold; border-radius: 5px; padding: 10px 20px; text-decoration: none; transition: 0.3s;"
            onmouseover="this.style.backgroundColor='#4A1E7A'" 
            onmouseout="this.style.backgroundColor='#5F259F'">
            View Transactions
        </a>
    </div>
</body>
</html>
