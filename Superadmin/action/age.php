<?php
include("../include/conn.php");

if(isset($_POST['submit'])){
    $min_age =  $_POST['min_age'];
      $max_age =$_POST['max_age'];
    $age_id = $_POST['age_id'];

  

    if ($age_id == '') {
        $msg = 'Record added successfully!';
        $sql = "INSERT INTO `age` (`min_age`, `max_age`) VALUES ('$min_age', '$max_age')";
    } else {
        $msg = 'Record updated successfully!';
        $sql = "UPDATE `age` SET `min_age` = '$min_age',`max_age`='$max_age' WHERE `age_id` = '$age_id'";
    }

    $query = mysqli_query($conn, $sql);
    if ($query) {
        header("Location: ../age_list?msg=$msg");
    }
}
?>
