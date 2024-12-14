<?php
include('include/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the id parameter is provided
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Delete the comment from the database
        $deleteQuery = "DELETE FROM comments WHERE id = $id";
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
