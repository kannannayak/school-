<?php
// Set up error reporting and session start
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
include_once 'objects/admin.php'; // Assuming 'user.php' contains the necessary user-related functions.
include_once 'objects/validate.php'; // Assuming 'user.php' contains the necessary user-related functions.

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

// Create User object
$user = new User($db);
$validate = new Validate($db);


// Decode JSON input
$data = json_decode(file_get_contents("php://input"));


if (!empty($data->api_key)) {
    $validate->api_key = $data->api_key;

    $stmt = $validate->getValidate();
    $itemCount = $stmt->rowCount();

    if ($itemCount > 0) {
        // Check if data is provided
        if ($data && isset($data->email) && isset($data->password)) {
            // Set user email and password
            $user->cus_email = $data->email;
            $user->cus_password = $data->password;

            // Check if the email exists in the database
            $stmt = $user->emailCheck();
            $itemCount = $stmt->rowCount();

            if ($itemCount > 0) {
               
                    
                    $stmt = $user->loginCheck();
                    $itemCount = $stmt->rowCount();
        
                    if ($itemCount > 0) {
                        $datas = array();
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    
        
                            extract($row);
                            $e = $row;
                            array_push($datas, $e);
    
                            echo json_encode(array("status" => true, "message" => "User login successful.", "data" => $row));
                            exit();
                        }
                    
                    

                

                } else { 
                    // Passwords don't match
                    http_response_code(401);
                    echo json_encode(['status' => false, 'message' => 'Invalid password']);
                }
            } else {
                // Email not found
                http_response_code(401);
                echo json_encode(['status' => false, 'message' => 'Email not registered']);
            }
        } else {
            // Incomplete data
            http_response_code(400);
            echo json_encode(['status' => false, 'message' => 'Incomplete data']);
        }
    } else {
        // Invalid API Key
        echo json_encode(array("status" => "Failed", "message" => "Api Key Not Match"));
    }
} else {
    // Missing API Key in JSON data
    echo json_encode(array("status" => "Failed", "message" => "API Key is missing."));
    exit();
}
