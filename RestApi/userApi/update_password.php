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

// Check if the required data is provided
if (isset($_POST['email_id']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
    $email_id = $_POST['email_id'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate that new_password and confirm_password match
    if ($new_password !== $confirm_password) {
        http_response_code(400);
        echo json_encode(['status' => false, 'message' => 'Passwords do not match']);
        exit;
    }

    // Create database and admin object
    $database = new Database();
    $db = $database->getConnection();
    $admin = new User($db);

    // Call the updatePassword method
    $result = $admin->updatePassword($email_id, $new_password);

    // Return the result as a JSON response
    http_response_code($result['status'] ? 200 : 400);
    echo json_encode($result);
} else {
    http_response_code(400);
    echo json_encode(['status' => false, 'message' => 'User ID, new password, and confirm password are required']);
}
?>
