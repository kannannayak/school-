<?php
include('include/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['rec_id'])) { // Ensure rec_id is accessed correctly
        $rec_id = $_POST['rec_id'];

        // Prepare the DELETE statement
        $stmt = $con->prepare("DELETE FROM website_record WHERE rec_id = ?");
        $stmt->bind_param("i", $rec_id);

        if ($stmt->execute()) {
            // Deletion successful
            echo "success";
        } else {
            // Deletion failed
            error_log("Error executing statement: " . $stmt->error);
            echo "error";
        }

        $stmt->close();
    } else {
        error_log("rec_id is not set.");
        echo "error";
    }
} else {
    error_log("Invalid request method: " . $_SERVER['REQUEST_METHOD']);
    echo "error";
}
?>
