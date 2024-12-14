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

// Check if API key and user ID are provided in the POST request
if (!empty($_POST['api_key']) && !empty($_POST['user_id'])) {
    $api_key = $_POST['api_key'];
    $user_id = $_POST['user_id'];

    $validate->api_key = $api_key;

    $stmt = $validate->getValidate();
    $itemCount = $stmt->rowCount();

    if ($itemCount > 0) {
        if (isset($_FILES['profile_pic'])) {
            $profile_pic = $_FILES['profile_pic'];

            // Define destination directory for profile picture
            $destinationProfile = 'upload/profile_pic/';

            // Create the destination folder if it doesn't exist
            if (!file_exists($destinationProfile) && !mkdir($destinationProfile, 0777, true)) {
                http_response_code(500);
                echo json_encode(['status' => false, 'message' => 'Failed to create profile picture directory']);
                exit;
            }

            // Define the destination file path
            $destinationProfileFilePath = $destinationProfile . basename($profile_pic['name']);

            // Attempt to move the uploaded file to the destination folder
            if (move_uploaded_file($profile_pic['tmp_name'], $destinationProfileFilePath)) {
                // Update the database with the new file path
                if ($user->updateProfilePic($user_id, $destinationProfileFilePath)) {
                    echo json_encode(array("status" => true, "message" => "Profile picture updated successfully", "profile_pic_url" => $destinationProfileFilePath));
                } else {
                    http_response_code(500);
                    echo json_encode(['status' => false, 'message' => 'Failed to update profile picture path in the database']);
                }
            } else {
                http_response_code(500);
                echo json_encode(['status' => false, 'message' => 'Failed to move uploaded profile picture']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['status' => false, 'message' => 'Incomplete data: profile_pic is required']);
        }
    } else {
        http_response_code(401);
        echo json_encode(array("status" => "Failed", "message" => "Invalid API Key"));
    }
} else {
    http_response_code(400);
    echo json_encode(array("status" => "Failed", "message" => "API Key and user_id are missing"));
}
?>
