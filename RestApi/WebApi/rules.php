<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
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

$product = new User($db);
$validate = new Validate($db);

$stmt = $product->rules();
$itemCount = $stmt->rowCount();

if ($itemCount > 0) {
    $rulesData = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $rulesData[]= $row['rules'];
    }
    http_response_code(200);
    echo json_encode(array("status" => "Success", "message" => "About Us", "rules" => $rulesData));
} else {
    http_response_code(404);
    echo json_encode(array("status" => "Failed", "message" => "No rules found."));
}
?>
