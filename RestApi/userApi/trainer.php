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

if (!empty($data->api_key) && !empty($data->school_id)) {
    $validate->api_key = $data->api_key;

    $stmt = $validate->getValidate();
    $itemCount = $stmt->rowCount();

    if ($itemCount > 0) {
        $school_id = $data->school_id;
        $stmt = $user->get_trainers($school_id);
        $itemCount = $stmt->rowCount();

        if ($itemCount > 0) {
            $datas = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $datas[] = $row;
            }
            http_response_code(200);
            echo json_encode(array("status" => "Success", "message" => "Get All Trainers", "Data" => $datas));
        } else {
            http_response_code(200);
            echo json_encode(array("status" => "Success", "message" => "No trainers found for the given school_id"));
        }
    } else {
        http_response_code(401);
        echo json_encode(array("status" => "Failed", "message" => "Invalid API key"));
    }
} else {
    http_response_code(400);
    echo json_encode(array("status" => "Failed", "message" => "Missing API key or school_id"));
}
?>
