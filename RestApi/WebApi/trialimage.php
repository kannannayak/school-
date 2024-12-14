<?php

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // If not a POST request, return a method not allowed error
    http_response_code(405);
    echo json_encode(array("status" => false, "message" => "Method not allowed"));
    exit(); // Stop script execution
}

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'config/database.php';
include_once 'objects/admin.php';

// Create a database connection
$database = new Database();
$db = $database->getConnection();

// Create a User object
$user = new User($db);

// Retrieve data from the request body
$data = json_decode(file_get_contents("php://input"));

// Fetch gallery data
$tournament = $user->fetchgallery();

// Check if gallery data was fetched successfully
if ($tournament !== false) {
    // If successful, return gallery data
    $status = true;
    $message = "Tournaments fetched successfully";
    echo json_encode(array("status" => $status, "message" => $message, "Tournament" => $tournament));
} else {
    // If failed, return an error message
    $status = false;
    $message = 'Failed to retrieve tournaments';
    echo json_encode(array("status" => $status, "message" => $message));
}

?>
