<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once 'config/database.php';
include_once 'objects/admin.php';


ini_set('error_reporting', 1);
ini_set('display_errors', 1);

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));
date_default_timezone_set('Asia/Calcutta');

$tournament = $user->fetchslider();
if ($tournament !== false) {
    $status = true;
    $message = "Slider fetched successfully";
    echo json_encode(array("status" => $status, "message" => $message, "Sliders" => $tournament));
} else {
    $status = false;
    $message = 'Failed to retrieve slider';
    echo json_encode(array("status" => $status, "message" => $message));
}

?>
