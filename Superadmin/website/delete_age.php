<?php
include('include/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the profileId parameter is provided
    if (isset($_POST['age_id'])) {
       $age_id = $_POST['age_id'];

        // Delete the retail user from the database
        $deleteQuery = "DELETE FROM website_agelist WHERE `age_id` = $age_id";
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