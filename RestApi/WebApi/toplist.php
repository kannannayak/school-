<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'config/database.php';
include_once 'objects/admin.php'; // Assuming user.php contains the User class
include_once 'objects/validate.php';

$database = new Database();
$db = $database->getConnection();

$User = new User($db);
$validate = new Validate($db);

$stmt = $User->toplist();
$itemCount = $stmt->rowCount();

if ($itemCount > 0) {
    $data = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $gameTypeId = $row['game_id'];
        $gender = $row['gender'];
        
        // Check if game type already exists in data array
        if (!isset($data[$gameTypeId])) {
            // If not, create a new entry for the game type
            $data[$gameTypeId] = array(
                
                'game_type_name' => $row['game_type_name'],
                
                'game_type_createed_dt' => $row['game_type_createed_dt'],
                'data' => array(
                    'Female' => array(), // Initialize Female array
                    'Male' => array() // Initialize Male array
                )
            );
        }
        
        // Add the current row data to the appropriate gender entry
        $rowData = array(
            'toper_id' => $row['toper_id'],
            'name' => $row['name'],
            'age' => $row['age'],
            'gender' => $row['gender'],
            'time' => $row['time'],
           
            'year' => $row['year'],
            'school_name' => $row['school_name'] // Add school name to the response
        );
        
        // Add the current row data to the appropriate gender entry
        $data[$gameTypeId]['data'][$gender][] = $rowData;
        
        // Sort Female data by time in ascending order
        if ($gender === 'Female') {
            usort($data[$gameTypeId]['data'][$gender], function($a, $b) {
                return $a['time'] - $b['time'];
            });
        }
    }
    
    http_response_code(200);
    echo json_encode(array("status" => "Success", "message" => "Top_list", "Data" => array_values($data)));
} else {
    http_response_code(401);
    echo json_encode(array("status" => "Failed", "message" => "No data Found"));
}
?>
data Found"));
}
?>