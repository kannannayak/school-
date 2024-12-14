<?php
include('include/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['acheiver_id'])) {
        $acheiver_id = $_POST['acheiver_id'];

        // Prepare the DELETE statement
        $stmt = $con->prepare("DELETE FROM achievers WHERE acheiver_id = ?");
        $stmt->bind_param("i", $acheiver_id);

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
        error_log("acheiver_id is not set.");
        echo "error";
    }
} else {
    error_log("Invalid request method: " . $_SERVER['REQUEST_METHOD']);
    echo "error";
}
?>
