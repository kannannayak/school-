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

$data = json_decode(file_get_contents("php://input"));

if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo json_encode(['status' => false, 'message' => 'Invalid JSON data: ' . json_last_error_msg()]);
    exit;
}

if (empty($data->api_key)) {
    http_response_code(400);
    echo json_encode(['status' => "Failed", 'message' => 'API Key is missing']);
    exit;
}

$validate->api_key = $data->api_key;
$stmt = $validate->getValidate();
$itemCount = $stmt->rowCount();

if ($itemCount > 0) {
    if (empty($data->user_id)) {
        http_response_code(400);
        echo json_encode(['status' => false, 'message' => 'No user_id provided']);
        exit;
    }

    $user_id = $data->user_id;
    $unseen_count = $user->get_unseen_notifications_count($user_id);

    if ($unseen_count === false) {
        http_response_code(500);
        echo json_encode(['status' => false, 'message' => 'Error retrieving data']);
    } else {
        echo json_encode(['status' => true, 'message' => 'Notification count retrieved', 'data' => ['unseen_count' => $unseen_count]]);
    }
} else {
    http_response_code(401);
    echo json_encode(['status' => "Failed", 'message' => 'Invalid API Key']);
}
?>
