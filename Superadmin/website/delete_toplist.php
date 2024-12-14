<?php
include('include/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the profileId parameter is provided
    if (isset($_POST['toper_id'])) {
        $toper_id = $_POST['toper_id'];

       
        $deleteQuery = "DELETE FROM topers_list_web WHERE `topers_list_web`.`toper_id` = $toper_id";
        
        $deleteResult = mysqli_query($con, $deleteQuery);

        if ($deleteResult) {
            // Deletion successful
            echo "success";
        } else {
            // Deletion failed
            echo "error";
        }
    }
}
?>
