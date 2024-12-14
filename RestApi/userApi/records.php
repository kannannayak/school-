<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// including necessary files
include_once 'config/database.php';
include_once 'objects/admin.php';
include_once 'objects/validate.php';

// creating database connection
$database = new Database();
$db = $database->getConnection();

// instantiating User and Validate objects
$user = new User($db);
$validate = new Validate($db);

// decoding json input
$data = json_decode(file_get_contents("php://input"));

// checking if API key is provided
if (!empty($data->api_key)) {
    $validate->api_key = $data->api_key;

    // validating API key
    $stmt = $validate->getValidate();
    $itemCount = $stmt->rowCount();

    if ($itemCount > 0) {
        if (!empty($data->user_id)) {
            // fetching records
            $game_id = isset($data->game_id) ? $data->game_id : null;
            $stmt = $user->records($data->user_id, $game_id);
            $itemCount = $stmt->rowCount();

            if ($itemCount > 0) {
                $records = array();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $records[] = $row;
                }
                echo json_encode(array("status" => true, "message" => "Records list fetched", "data" => $records));
            } else {
                http_response_code(400);
                echo json_encode(array("status" => false, "message" => "No records found"));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("status" => false, "message" => "User ID is missing."));
        }
    } else {
        echo json_encode(array("status" => "Failed", "message" => "API Key Not Match"));
    }
} else {
    echo json_encode(array("status" => "Failed", "message" => "API Key is missing."));
    exit();
}
?>
