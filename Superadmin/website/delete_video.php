<?php
include('include/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the profileId parameter is provided
    if (isset($_POST['id'])) {
       $id = $_POST['id'];

        // Delete the retail user from the database
        $deleteQuery = "DELETE FROM tutorial WHERE `tutorial`.`tut_id` = $id";
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