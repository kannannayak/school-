<?php
include('include/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the profileId parameter is provided
    if (isset($_POST['game_type_id'])) {
       $game_type_id = $_POST['game_type_id'];

        // Delete the retail user from the database
        $deleteQuery = "DELETE FROM game_type_web WHERE `game_type_web`.`game_type_id` = $game_type_id";
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