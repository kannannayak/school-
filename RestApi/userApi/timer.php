<?php
// Set error reporting and session start
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

// Set CORS headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Include necessary files
include_once 'config/database.php';
include_once 'objects/admin.php';
include_once 'objects/validate.php';

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

// Instantiate objects
$user = new User($db);
$validate = new Validate($db);

// Get POST data
$data = json_decode(file_get_contents("php://input"), true);

// Check if API key is provided
if (!empty($data['api_key'])) {
    $validate->api_key = $data['api_key'];
    $stmt = $validate->getValidate();
    $itemCount = $stmt->rowCount();

    // Validate API key
    if ($itemCount > 0) {
        // Check for required fields
        $requiredFields = ['game_id','user_id','total_time'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                http_response_code(400);
                echo json_encode(['status' => false, 'message' => ucfirst($field) . ' is missing']);
                exit();
            }
        }

        // Assign values from POST data
        $user->game_id = $data['game_id'];
          $user->user_id = $data['user_id'];
        // $user->start_time = $data['start_time'];
        // $user->end_time = $data['end_time'];
        $user->total_time = $data['total_time'];

        // Insert record into database
        if ($user->timer()) {
            http_response_code(200);
            echo json_encode(['status' => true, 'message' => 'Registered successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => false, 'message' => 'Registration failed']);
        }
    } else {
        // Invalid API key
        echo json_encode(['status' => 'Failed', 'message' => 'API Key Not Match']);
    }
} else {
    // API key is missing
    echo json_encode(['status' => 'Failed', 'message' => 'API Key is missing.']);
    exit();
}
?>
