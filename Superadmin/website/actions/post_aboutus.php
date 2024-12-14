<?php
include('../include/config.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all necessary fields are set
    if(isset($_POST['about_id'], $_POST['Students'], $_POST['Awards'], $_POST['trainers'])) {
        // Sanitize input data
        $about_id = intval($_POST['about_id']);
        $Students = trim($_POST['Students']);
        $Awards = trim($_POST['Awards']);
        $trainers = trim($_POST['trainers']);

        // Check if any field is empty
        if (empty($Students) || empty($Awards) || empty($trainers)) {
            echo "All fields are required.";
            exit;
        }

        // Prepare the SQL query
        $stmt = $con->prepare("UPDATE `about_us_number` SET Students=?, Awards=?, trainers=? WHERE about_id=?");
        $stmt->bind_param("sssi", $Students, $Awards, $trainers, $about_id);

        if($stmt->execute()) {
            echo "Record updated successfully";
            echo "<script>window.location.href ='../aboutus_number';</script>";
        } else {
            echo "Error updating record: " . $stmt->error;
        }
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request.";
}
?>
