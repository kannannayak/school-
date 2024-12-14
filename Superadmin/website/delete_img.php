<?php
include('include/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the profileId parameter is provided
    if (isset($_POST['image_id'])) {
       $image_id = $_POST['image_id'];

        // Delete the retail user from the database
        $deleteQuery = "DELETE FROM image_web WHERE `image_web`.`image_id` = $image_id";
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