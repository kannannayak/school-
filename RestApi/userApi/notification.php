<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

// Required headers for CORS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Include necessary files
include_once 'config/database.php';
include_once 'objects/admin.php';
include_once 'objects/validate.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$validate = new Validate($db);


$data = json_decode(file_get_contents("php://input"));

if (!empty($data->api_key)) {
    $validate->api_key = $data->api_key;

    $stmt = $validate->getValidate();
    $itemCount = $stmt->rowCount();

    if ($itemCount > 0) {
        // Assuming you have a user_id in your data object, replace 'user_id' with your actual property name
        if (isset($data->user_id)) {
            $user_id = $data->user_id;

            $notifications = $user->fetchnotification($user_id);
            $itemCount = count($notifications);

            if ($itemCount > 0) {
                http_response_code(200);
                echo json_encode(array("status" => "Success", "message" => "Get Notification", "Data" => $notifications));
            } else {
                http_response_code(400);
                echo json_encode(array("status" => "Failed", "message" => "No notifications found for this user"));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("status" => "Failed", "message" => "User ID is required"));
        }
    } else {
        http_response_code(401);
        echo json_encode(array("status" => "Failed", "message" => "Invalid API key"));
    }
} else {
    http_response_code(400);
    echo json_encode(array("status" => "Failed", "message" => "API key is required"));
}
