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
        $requiredFields = ['name', 'parent_name', 'gender', 'dob', 'school_id', 'address', 'district', 'state', 'pincode', 'email', 'phone', 'password', 'confirm_pass', 'trainer_id'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                http_response_code(400);
                echo json_encode(['status' => false, 'message' => ucfirst($field) . ' is missing']);
                exit();
            }
        }

        // Assign values to User object properties
        $user->cus_name = $data['name'];
        $user->cus_parent_name = $data['parent_name'];
        $user->cus_gender = $data['gender'];
        $user->cus_email = $data['email'];
        $user->cus_mobile = $data['phone'];
        $user->cus_dob = $data['dob'];
        $user->cus_school = $data['school_id'];
        $user->cus_address = $data['address'];
        $user->cus_district = $data['district'];
        $user->cus_state = $data['state'];
        $user->cus_pincode = $data['pincode'];
        $user->cus_password = $data['password'];
        $user->cus_confirm_pass = $data['confirm_pass'];
        $user->cus_trainer_id = $data['trainer_id'];

        // Optional file uploads
        $user->cus_id_proof = $_FILES['proof'] ?? null;
        $user->cus_profile_pic = $_FILES['profile'] ?? null;

        // Perform phone and email checks
        $stmt = $user->phoneCheck();
        $itemCount = $stmt->rowCount();
        if ($itemCount > 0) {
            http_response_code(400);
            echo json_encode(["status" => false, "message" => "Mobile Number Already Exists."]);
            exit();
        }

        $stmt = $user->emailCheck();
        $itemCount = $stmt->rowCount();
        if ($itemCount > 0) {
            http_response_code(400);
            echo json_encode(["status" => false, "message" => "Email Id Already Exists."]);
            exit();
        }

        // Register the user
        $res = $user->Register();

        if ($res) {
            http_response_code(200);
            echo json_encode(['status' => true, 'message' => 'Registered successfully']);
        } else {
            http_response_code(400);
            echo json_encode(['status' => false, 'message' => 'Registration failed. Please check your details and try again.']);
        }
    } else {
        http_response_code(400);
        echo json_encode(["status" => "Failed", "message" => "API Key Not Match"]);
    }
} else {
    http_response_code(400);
    echo json_encode(["status" => "Failed", "message" => "API Key is missing."]);
    exit();
}
