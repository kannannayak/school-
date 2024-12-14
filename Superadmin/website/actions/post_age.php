<?php
include('../include/config.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all necessary fields are set
    if(isset($_POST['age_name'])) {
        // Sanitize input data
        $age_id = intval($_POST['age_id']); // Assuming age_id is used elsewhere or for future use
        $age_name = trim($_POST['age_name']);
        
        // Check if any field is empty
        if (empty($age_name)) {
            echo "All fields are required.";
            exit;
        }

        // Prepare the SQL query
        $stmt = $con->prepare("INSERT INTO `website_agelist` (age_name) VALUES (?)");

        // Bind parameters
        $stmt->bind_param("s", $age_name);

        // Execute the query and check for errors
        if ($stmt->execute()) {
            echo "Age Created successfully";
            echo "<script>window.location.href ='../age_list';</script>";
        } else {
            echo "Error inserting record: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid request.";
}

// Close the connection
$con->close();
?>
