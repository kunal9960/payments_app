<?php 
const APP_URL = "https://paymentsapp.free.nf/package";
// check environment...

// callback_url or webhook url
const WEBHOOK_PATH = APP_URL."/webhook.php"; // where you will be notify instantly when payment success or failed

// redirect url or response url : after payment success or failed, user will be redirect here..
// Note : ignore the warning error if you getting this.. ( you cann hide its by php code : error_reporting(0); at the top level code )
const RESPONSE_PATH = APP_URL."/response.php";

// Database Connection Details
const DB_HOST = "infinityfree.com";  // Your MySQL Hostname
const DB_USER = "password";  // Your MySQL Username
const DB_PASS = "username";  // Your MySQL Password
const DB_NAME = "payments_db";  // Your MySQL Database Name

// TESTING Credentials... - OK
const ENV = "UAT";
const API_KEY = "96434309-7796-489d-8924-ab56988a6076";
const API_KEY_INDEX = 1;
const API_MERCHAT_ID = "PGTESTPAYUAT86";

// Create a database connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

