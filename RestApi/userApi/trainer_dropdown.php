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

// Create a database connection
$database = new Database();
$db = $database->getConnection();

// Initialize user object
$user = new User($db);

// Fetch the JSON input data
$data = json_decode(file_get_contents("php://input"));

// Check if the data exists

    // Fetch trainers data
    $stmt = $user->get_trainers_dropdown();
    $itemCount = $stmt->rowCount();

    // Check if trainers data is available
    if ($itemCount > 0) {
        $datas = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $datas[] = $row; // Add each row to the data array
        }
        http_response_code(200);
        echo json_encode(array("status" => "Success", "message" => "Get All Trainers", "Data" => $datas));
    } else {
        http_response_code(400);
        echo json_encode(array("status" => "Failed", "message" => "No trainers found"));
    }

?>
