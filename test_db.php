<?php
require_once 'config.php';

if ($conn->ping()) {
    echo "✅ Database connection is successful!";
} else {
    echo "❌ Error: " . $conn->error;
}
?>