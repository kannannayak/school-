<?php
include("../include/conn.php");



if (isset($_POST['submit'])) {
    // Sanitize input
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $selected_users = isset($_POST['user']) ? $_POST['user'] : [];

    // Handle "Select ALL" option
    if (in_array('all', $selected_users)) {
        $result = mysqli_query($conn, "SELECT user_id FROM users");
        $selected_users = [];
        while ($user_row = mysqli_fetch_array($result)) {
            $selected_users[] = $user_row['user_id'];
        }
    }

    // Get the current date and time in 12-hour format
    date_default_timezone_set('Asia/Kolkata');
    $current_time = date('Y-m-d h:i:s A');

    // Insert notification into database
    $sql = "INSERT INTO `notification` (`user_id`, `message`, `msg_sent_time`) VALUES ";
    $values = [];
    foreach ($selected_users as $user_id) {
        $values[] = "('$user_id', '$message', '$current_time')";
    }
    $sql .= implode(',', $values);

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Message Sent successfully!');</script>";
        echo "<script>window.location.href ='../notifi.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_POST['tri_submit'])) {
    // Sanitize input
    $message = mysqli_real_escape_string($conn, $_POST['tri_message']);
    $selected_users = isset($_POST['trainer']) ? $_POST['trainer'] : [];

    // Handle "Select ALL" option
    if (in_array('all', $selected_users)) {
        $result = mysqli_query($conn, "SELECT trainer_id FROM trainer WHERE trainer_status = '1'");
        $selected_users = [];
        while ($user_row = mysqli_fetch_array($result)) {
            $selected_users[] = $user_row['trainer_id'];
        }
    }

    // Get the current date and time in 12-hour format
    date_default_timezone_set('Asia/Kolkata');
    $current_time = date('Y-m-d h:i:s A');

    // Insert notification into database
    $sql1 = "INSERT INTO `trainer_notification` (`trainer_id`, `msg_for_trainer`, `msg_sent_time`) VALUES ";
    $values = [];
    foreach ($selected_users as $trainer_id) {
        $values[] = "('$trainer_id', '$message', '$current_time')";
    }
    $sql1 .= implode(',', $values);

    if ($conn->query($sql1) === TRUE) {
        echo "<script>alert('Message Sent successfully!');</script>";
        echo "<script>window.location.href ='../notifi.php';</script>";
    } else {
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    }
}

if (isset($_POST['sch_submit'])) {
    // Sanitize input
    $message = mysqli_real_escape_string($conn, $_POST['sch_message']);
    $selected_users = isset($_POST['school']) ? $_POST['school'] : [];

    // Handle "Select ALL" option
    if (in_array('all', $selected_users)) {
        $result = mysqli_query($conn, "SELECT school_id FROM school_list");
        $selected_users = [];
        while ($user_row = mysqli_fetch_array($result)) {
            $selected_users[] = $user_row['school_id'];
        }
    }

    // Get the current date and time in 12-hour format
    date_default_timezone_set('Asia/Kolkata');
    $current_time = date('Y-m-d h:i:s A');

    // Insert notification into database
    $sql1 = "INSERT INTO `school_notification` (`school_id`, `schl_msg`, `msg_sent`) VALUES ";
    $values = [];
    foreach ($selected_users as $school_id) {
        $values[] = "('$school_id', '$message', '$current_time')";
    }
    $sql1 .= implode(',', $values);

    if ($conn->query($sql1) === TRUE) {
        echo "<script>alert('Message Sent successfully!');</script>";
        echo "<script>window.location.href ='../notifi.php';</script>";
    } else {
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    }
}
?>
