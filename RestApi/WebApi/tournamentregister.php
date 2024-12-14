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
include_once 'objects/admin.php'; // Assuming 'User' is the appropriate object for user-related operations
include_once 'objects/validate.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$validate = new Validate($db);

$data = $_POST;

if (
    isset($data['name']) &&
    isset($data['email']) &&
    isset($data['gender']) &&
    isset($data['age']) &&
    isset($data['grade']) &&
    isset($data['phone']) &&
    isset($data['schoolname']) &&
    isset($data['address']) &&
    isset($data['district']) &&
    isset($data['pincode']) &&
    isset($data['tourn_id'])
) {
    // Assign values from JSON data to User object properties
    $user->tourn_id = $data['tourn_id'];
    $user->cus_name = $data['name'];
    $user->cus_email = $data['email'];
    $user->cus_gender = $data['gender'];
    $user->cus_age = $data['age'];
    $user->cus_grade = $data['grade'];
    $user->cus_phone = $data['phone'];
    $user->cus_schoolname = $data['schoolname'];
    $user->cus_address = $data['address'];
    $user->cus_district = $data['district'];
    $user->cus_pincode = $data['pincode'];

    // Call the method to register tournament
    $res = $user->TournamentRegister();

    // Check if registration was successful or not
    if ($res) {
        // If successful, return success response
        http_response_code(200);
        echo json_encode(['status' => true, 'message' => 'Tournament Registered successfully']);
    } else {
        // If registration failed, return error response
        http_response_code(500);
        echo json_encode(['status' => false, 'message' => 'Tournament Registration Failed']);
    }
} else {
    // If required fields are not set in the JSON data, return incomplete data error response
    http_response_code(400);
    echo json_encode(['status' => false, 'message' => 'Incomplete data']);
}
?>
