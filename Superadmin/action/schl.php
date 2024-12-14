<?php
include("../include/conn.php");

if (isset($_POST['submit'])) {
    $school_name = str_replace("'", "''", $_POST['school_name']);
    $school_location = str_replace("'", "''", $_POST['school_location']);
    $school_email = str_replace("'", "''", $_POST['school_email']);
    $school_pass = str_replace("'", "''", $_POST['school_pass']);
    $school_id = $_POST['school_id'];

    $time_now = mktime(date('h') + 3, date('i') + 30, date('s'));
    $date = date('Y-m-d h:i:s', $time_now);

    if (empty($school_id)) {
        $msg = 'Record added successfully!';
        $sql = "INSERT INTO `school_list`(`school_name`, `school_location`, `school_email`, `school_pass`) VALUES ('{$school_name}', '{$school_location}', '{$school_email}', '{$school_pass}')";
    } else {
        $msg = 'Record updated successfully!';
        $sql = "UPDATE `school_list` SET `school_name` = '{$school_name}', `school_location` = '{$school_location}', `school_email` = '{$school_email}', `school_pass` = '{$school_pass}' WHERE `school_id` = '{$school_id}'";
    }

    $query = mysqli_query($conn, $sql);
    if ($query) {
        header("location:../school?msg=$msg");
    } else {
        $msg = 'Database operation failed!';
        header("location:../school?msg=$msg");
    }
}
?>
