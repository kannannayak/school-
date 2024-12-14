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

if (!empty($data->api_key)) {
    $validate->api_key = $data->api_key;

    $stmt = $validate->getValidate();
    $itemCount = $stmt->rowCount();

    if ($itemCount > 0) {
        if (isset($data->record_id) && !empty($data->record_id)) {
            $user->record_id = $data->record_id;

            $result = $user->del();

            if ($result['status']) {
                http_response_code(200);
            } else {
                http_response_code(400);
            }

            echo json_encode($result);
        } else {
            http_response_code(400);
            echo json_encode(['status' => false, 'message' => 'No record_id provided']);
        }
    } else {
        // Invalid API Key
        http_response_code(401);
        echo json_encode(['status' => false, 'message' => 'Invalid API Key']);
    }
} else {
    // Missing API Key
    http_response_code(400);
    echo json_encode(['status' => false, 'message' => 'API Key is missing']);
}
?>
