<?php
require_once __DIR__ . '/../config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/584/584052.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #dcdcdc; /* Grey Background */
        }
        .card {
            background: transparent;
            border: none;
            box-shadow: none;
        }
        .table {
            border: 2px solid #000000; /* Black Border */
            border-radius: 10px; /* Rounded Corners */
            overflow: hidden;
        }
        .table th, .table td {
            border: 1px solid #000000;
        }
        tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }
        tbody tr:nth-child(even) {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="container mt-0">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center" style="color: #5F259F;">
                    <img src="https://cdn-icons-png.flaticon.com/512/4248/4248443.png" alt="Database Icon" width="35" height="35" class="me-2">
                    <b><u>Transaction History</u></b>
                    <h5 class="text-center" style="color: #5F259F;"><u>Fetched from phpmyadmin database</u></h5>
                </h3>
                <table class="table table-bordered mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>Order ID</th>
                            <th>Name</th>
                            <th>Mobile Number</th>
                            <th>Amount (₹)</th>
                            <th>Status</th>
                            <th>Transaction ID</th>
                            <th>Date & Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT order_id, name, mobile_number, amount, status, transaction_id, created_at FROM transactions ORDER BY created_at DESC";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['order_id']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['mobile_number']}</td>
                                    <td>{$row['amount']}</td>
                                    <td><b>{$row['status']}</b></td>
                                    <td>{$row['transaction_id']}</td>
                                    <td>{$row['created_at']}</td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center mb-1">
            <a href="index.php" class="btn btn-secondary"><b>Go Back</b></a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
