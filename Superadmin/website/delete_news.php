<?php
include('include/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the profileId parameter is provided
    if (isset($_POST['news_id'])) {
       $news_id = $_POST['news_id'];

        // Delete the retail user from the database
        $deleteQuery = "DELETE FROM  news WHERE `news`.`news_id` = $news_id";
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