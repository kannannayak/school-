<?php
include("../include/conn.php");
include("../include/header.php");

if (isset($_POST['submit'])) {
    // Sanitize input
    $trainer_id = $_SESSION['trainer_id'];
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $selected_users = isset($_POST['user']) ? $_POST['user'] : [];
    
    date_default_timezone_set('Asia/Kolkata');
    $current_time = date('Y-m-d h:i:s A');

    if (!empty($selected_users)) {
        // Insert notification into database
        $sql = "INSERT INTO notification (user_id, message, msg_sent_time, trainer_id) VALUES ";
        $values = [];

        foreach ($selected_users as $user_id) {
            $user_id = mysqli_real_escape_string($conn, $user_id); // Ensure each user ID is properly escaped
            $values[] = "('$user_id', '$message', '$current_time', '$trainer_id')";
        }

        $sql .= implode(',', $values);

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Message sent successfully!');</script>";
            echo "<script>window.location.href ='../notify.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<script>alert('No users selected!');</script>";
        echo "<script>window.location.href ='../notify.php';</script>";
    }
}
?>
