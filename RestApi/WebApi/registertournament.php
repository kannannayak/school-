<?php
// Handle OPTIONS request for CORS preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Origin: http://localhost:3000");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: *");
    exit;
}

// Set error reporting to display errors for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Start session if needed
session_start();

// Set headers for CORS and JSON response
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");

// Include necessary files for database and object
include_once 'config/database.php';
include_once 'objects/admin.php'; // Ensure this points to the correct file for your User object

// Create a database connection
$database = new Database();
$db = $database->getConnection();

// Create User object
$user = new User($db);

// Get form data sent using POST method
$data = $_POST;

// Check if required fields are set
if (
    !empty($data['name']) &&
    !empty($data['trainer_id']) &&
    !empty($data['gender']) &&
    !empty($data['phone']) &&
    !empty($data['schl_name']) &&
    !empty($data['parent_name']) &&
    !empty($data['dob']) &&
    !empty($data['tournament'])
) {
    // Assign values from form data to User object properties
    $user->name = $data['name'];
    $user->trainer_id = $data['trainer_id'];
    $user->otherCoach = $data['otherCoach'] ?? null; // Check if otherCoach is set
    $user->gender = $data['gender'];
    $user->phone = $data['phone'];
    $user->schl_name = $data['schl_name'];
    $user->parent_name = $data['parent_name'];
    $user->dob = $data['dob'];
    $user->tournament = $data['tournament'];

    // Call the method to register the tournament
    if ($user->registertournament()) {
        http_response_code(200);
        echo json_encode(['status' => true, 'message' => 'Registration successfully completed']);
    } else {
        http_response_code(500);
        echo json_encode(['status' => false, 'message' => 'Failed to insert data']);
    }
} else {
    // If required fields are not set in the JSON data, return incomplete data error response
    http_response_code(400);
    echo json_encode(['status' => false, 'message' => 'Incomplete data']);
}
?>
