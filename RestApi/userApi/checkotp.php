<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'config/database.php';
include_once 'objects/admin.php';

// Check if the email_id and OTP are provided
if (isset($_POST['email_id']) && isset($_POST['otp'])) {
    $email_id = $_POST['email_id'];
    $otp = $_POST['otp'];

    // Debug: Log the email_id and OTP
    error_log("Email ID: " . $email_id);
    error_log("OTP: " . $otp);

    // Create database and admin object
    $database = new Database();
    $db = $database->getConnection();
    $admin = new User($db);

    // Call the checkOTP method
    $result = $admin->checkOTP($email_id, $otp);

    // Debug: Log the result
    error_log("Result: " . json_encode($result));

    // Return the result as a JSON response
    http_response_code($result['status'] ? 200 : 400);
    echo json_encode($result);
} else {
    http_response_code(400);
    echo json_encode(['status' => false, 'message' => 'Email ID and OTP are required']);
}
?>
