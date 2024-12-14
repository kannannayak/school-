<?php
include("../include/conn.php");

if(isset($_POST['submit'])){
    $name = str_replace("'", "''", $_POST['name']);
    $game_id = str_replace("'", "''", $_POST['game_id']);

    $time_now = mktime(date('h') + 3, date('i') + 30, date('s'));
    $date = date('Y-m-d', $time_now);

    if ($game_id == '') {
        $msg = 'Record added successfully!';
        $sql = "INSERT INTO `game_type_web` (`game_type_name`, game_type_createed_dt) VALUES ('$name', '$date')";
    } else {
        $msg = 'Record updated successfully!';
        $sql = "UPDATE `game_type_web` SET `game_type_name` = '$name' WHERE `game_type_id` = '$game_id'";
    }

    $query = mysqli_query($conn, $sql);
    if ($query) {
        header("Location: ../games?msg=$msg");
    }
}
?>
