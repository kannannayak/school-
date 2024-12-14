<?php
include('include/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['img_id'])) {
        $img_id = $_POST['img_id'];

        // Prepare the DELETE statement
        $stmt = $con->prepare("DELETE FROM sports_tacking_img WHERE img_id = ?");
        $stmt->bind_param("i", $img_id);

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
        error_log("img_id is not set.");
        echo "error";
    }
} else {
    error_log("Invalid request method: " . $_SERVER['REQUEST_METHOD']);
    echo "error";
}
?>
