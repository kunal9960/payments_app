<?php 
require_once __DIR__ . '/../config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/584/584052.png">
</head>
<style>
body {
    background: url('https://github.com/kunal9960/payments_app/blob/master/Source/Payments%20APP.png?raw=true') no-repeat center center fixed;
    background-size: cover;
    backdrop-filter: blur(0.2px);
}
</style>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class='col-12 my-2 d-flex justify-content-center'>
                <div class="spinner-border text-white mx-2" role="status" style="width:1.4rem;height:1.4rem">
                  <span class="visually-hidden">Loading...</span>
                </div>
                <h4 class="text-center text-white" style="font-family: 'Open Sans', sans-serif; font-size:22px; font-weight: bold;">Your payment is currently being processed...</h4>
            </div>
            <div class="col-md-6">
                <div class="card" style="border: 3.5px solid #5F259F; border-radius: 15px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <h3 class="card-title m-0" style="color: #5F259F; padding-bottom: 12px;"><B><u>Order Payment</u></B></h3>
                            <div class="d-flex">
                                <img src="https://raw.githubusercontent.com/kunal9960/payments_app/refs/heads/master/Source/paytm-logo.png" alt="Paytm" width="50" height="35" class="ms-2">
                                <img src="https://raw.githubusercontent.com/kunal9960/payments_app/refs/heads/master/Source/phonepe-logo.png" alt="PhonePe" width="40" height="38" class="ms-2">
                                <img src="https://raw.githubusercontent.com/kunal9960/payments_app/refs/heads/master/Source/google-pay-logo.png" alt="GPay" width="42" height="40" class="ms-2">
                            </div>
                        </div>

                        <form id="paymentForm" onsubmit="displayProcessingText()" action="<?= APP_URL ?>/request.php" method="POST">
                            <legend><b>Payment Details</b></legend>
                            <div class='row'>

                                <!-- Enter Your Name -->
                                <div class="mb-1 mt-2 col-md-12">
                                    <label for="user_name" class="form-label">
                                        <img src="https://cdn-icons-png.flaticon.com/512/2922/2922506.png" alt="User Icon" width="20" height="20" class="me-1">
                                        Customer's Name <span class='text-danger'>*</span>
                                    </label>
                                    <input type="text" class="form-control" name="user_name" placeholder="Enter your full name" required>
                                </div>

                                <!-- Customer's Phone Number -->
                                <div class="mb-3 mt-2 col-md-12">
                                    <label for="customer_number" class="form-label">
                                        <img src="https://cdn-icons-png.flaticon.com/512/3059/3059502.png" alt="Phone Icon" width="20" height="20" class="me-1">
                                        Customer's Phone Number <span class='text-danger'>*</span>
                                    </label>
                                    <input type="text" minlength="10" maxlength="10" class="form-control" name="mobileNumber" placeholder="Enter your phone number" required>
                                </div>

                                <!-- Order ID -->
                                <div class="mb-3 col-md-12">
                                    <label for="order_id" class="form-label">
                                        <img src="https://cdn-icons-png.flaticon.com/512/839/839860.png" alt="Order ID Icon" width="25" height="25" class="me-1">
                                        Order ID <span class='text-danger'>*</span>
                                    </label>
                                    <input type="text" class="form-control" id="order_id" name="order_id" value="<?php echo 'order_' . uniqid(); ?>" readonly>
                                </div>

                                <!-- Order Amount -->
                                <div class="mb-3 col-md-12">
                                    <label for="order_amount" class="form-label">
                                        <img src="https://cdn-icons-png.flaticon.com/512/15722/15722759.png" alt="Amount Icon" width="27" height="27" class="me-1">
                                        Order Amount (₹) <span class='text-danger'>*</span>
                                    </label>
                                    <input type="text" class="form-control" id="order_amount" name="order_amount" placeholder="Enter the amount" required>
                                </div>

                                <!-- Submit Button -->
                                <div class="text-center">
                                    <button id="submitButton" type="submit" class="btn" 
                                        style="background-color: #5F259F; color: white; border: none; font-weight: bold; transition: 0.3s;" 
                                        onmouseover="this.style.backgroundColor='#4A1E7A'" 
                                        onmouseout="this.style.backgroundColor='#5F259F'">
                                        Make Payment
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        function displayProcessingText() {
            document.getElementById('submitButton').innerText = 'Please Wait';
        }
    </script>
</body>
</html>