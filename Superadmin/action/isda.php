<?php
include("../include/conn.php");

if(isset($_POST['submit'])){
    $name = str_replace("'", "''", $_POST['name']);
    $gender_id = str_replace("'", "''", $_POST['gender_id']);
    $age = str_replace("'", "''", $_POST['age']);
    $game_type_id = str_replace("'", "''", $_POST['game_type_id']);
    $game_timing = str_replace("'", "''", $_POST['game_timing']);
    $record_id = str_replace("'", "''", $_POST['record_id']);

    // Determine age_id based on age range
    if ($age >= 10 && $age <= 15) {
        $age_id = 4;
    } elseif ($age >= 16 && $age <= 20) {
        $age_id = 5;
    } elseif ($age >= 21 && $age <= 25) {
        $age_id = 6;
    } elseif ($age >= 26 && $age <= 30) {
        $age_id = 7;
    } elseif ($age >= 5 && $age <= 9) {
        $age_id = 8;
    } else {
        // Handle cases where age doesn't fall into any predefined range
        // You may choose to set a default age_id or display an error message
        // For this example, let's set a default age_id
        $age_id = 4; // Default age_id
    }

    $time_now = mktime(date('h') + 3, date('i') + 30, date('s'));
    $date = date('Y-m-d h:i:s', $time_now);

    if ($record_id == '') {
        $msg = 'Record added successfully!';
        $sql = "INSERT INTO `isda_records` (`name`, `gender_id`, `age`, `game_type_id`, `game_timing`, `age_id`) VALUES ('$name', '$gender_id', '$age', '$game_type_id', '$game_timing', '$age_id')";
    } else {
        $msg = 'Record updated successfully!';
        $sql = "UPDATE `isda_records` SET `name` = '$name', `gender_id` = '$gender_id', `age` = '$age', `game_type_id` = '$game_type_id', `game_timing` = '$game_timing', `age_id` = '$age_id' WHERE `record_id` = '$record_id'";
    }

    $query = mysqli_query($conn, $sql);
    if ($query) {
        header("Location: ../isda_record?msg=$msg");
    }
}
?>
