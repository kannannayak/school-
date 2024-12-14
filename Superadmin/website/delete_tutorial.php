<?php
include('include/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the profileId parameter is provided
    if (isset($_POST['tutorial_web_id'])) {
        $tutorial_web_id = $_POST['tutorial_web_id'];

        // Delete the retail user from the database
        $deleteQuery = "DELETE FROM  tutorial_web WHERE `tutorial_web`.`tutorial_web_id` = $tutorial_web_id";
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
