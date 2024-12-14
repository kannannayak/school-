<?php

include("../include/conn.php");

if (isset($_POST['drivermessage'])) {

    function validateInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $drivermsg = validateInput($_POST['drivermsg']);
    $sql1 = "INSERT INTO `notification` (`message`) VALUES ('$drivermsg')";

    if (mysqli_query($conn, $sql1)) {
        header("location: ../notifi.php?msg=Notification Sent Successfully");
        exit();
    } else {
        echo "Something went wrong: " . mysqli_error($conn);
    }
}

if (isset($_POST['coordmessage'])) {

    function validateInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $coordinatormsg = validateInput($_POST['coordinatormsg']);
    $sql2 = "INSERT INTO trainer_notification (msg_for_trainer) VALUES ('$coordinatormsg')";

    if (mysqli_query($conn, $sql2)) {
        header("location: ../notifi.php?msg=Notification Sent Successfully");
        exit();
    } else {
        echo "Something went wrong: " . mysqli_error($conn);
    }
}