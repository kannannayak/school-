<?php
// Set error reporting to display errors
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Start session (if needed)
session_start();

// Set headers for CORS and JSON response
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Include necessary files
include_once 'config/database.php';
include_once 'objects/admin.php'; // Assuming 'User' is the appropriate object for user-related operations

// Create a database connection
$database = new Database();
$db = $database->getConnection();

// Create User object
$user = new User($db);

// Get data from POST request
$data = $_POST;

// Check if required fields are set
if (
    !empty($data['name']) &&
    !empty($data['email']) &&
    !empty($data['phone']) &&
    !empty($data['comments'])
) {
    // Assign values from JSON data to User object properties
    $user->name = $data['name'];
    $user->email = $data['email'];
    $user->phone = $data['phone'];
    $user->comments = $data['comments'];

    // Call the method to insert comments
    if ($user->comments()) {
        // If successful, return success response
        http_response_code(200);
        echo json_encode(['status' => true, 'message' => 'Comments inserted successfully']);
    } else {
        // If insertion failed, return error response
        http_response_code(500);
        echo json_encode(['status' => false, 'message' => 'Failed to insert comments']);
    }
} else {
    // If required fields are not set in the JSON data, return incomplete data error response
    http_response_code(400);
    echo json_encode(['status' => false, 'message' => 'Incomplete data']);
}
?>

