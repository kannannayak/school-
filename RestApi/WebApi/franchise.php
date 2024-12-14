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
include_once 'objects/validate.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$validate = new Validate($db);

$data = $_POST; // Access form-data directly

if (!empty($data['api_key'])) {
    $validate->api_key = $data['api_key'];

    $stmt = $validate->getValidate();
    $itemCount = $stmt->rowCount();

    if ($itemCount > 0) {
        // Check if required fields are set
        $requiredFields = ['name', 'phone_number', 'email_id', 'investment', 'state', 'city'];
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                http_response_code(400);
                echo json_encode(['status' => false, 'message' => ucfirst($field) . ' is missing']);
                exit();
            }
        }

        // Assign values to User object properties
        $user->name = $data['name'];
        $user->phone_number = $data['phone_number'];
        $user->email_id = $data['email_id'];
        $user->investment = $data['investment'];
        $user->state = $data['state'];
        $user->city = $data['city'];
        
        // Register the user
        $res = $user->franchise();

        if ($res) {
            http_response_code(200);
            echo json_encode(['status' => true, 'message' => 'Franchise registered successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => false, 'message' => 'Franchise registration failed']);
        }
    } else {
        http_response_code(401);
        echo json_encode(["status" => "Failed", "message" => "API Key does not match"]);
    }
} else {
    http_response_code(400);
    echo json_encode(["status" => "Failed", "message" => "API Key is missing."]);
    exit();
}
?>
