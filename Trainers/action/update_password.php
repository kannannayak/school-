<?php
session_start(); // Start the session

include("../include/conn.php");



if (isset($_POST['submit'])) {
    $confirmPassword = $_POST['confirmPassword'];
  
    // Retrieve trainer_id from session
    $mail = $_SESSION['mail'];

    $sql = "UPDATE trainer
            SET tlog_pass = '$confirmPassword'
            WHERE trainer_email = '$mail'";
            
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Password updated successfully!');</script>";
        echo "<script>window.location.href ='../login.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}
    
  