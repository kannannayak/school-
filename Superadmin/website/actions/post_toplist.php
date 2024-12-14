<?php
include('../include/config.php');

if (isset($_POST['update_profile'])) {
    $game_id = $_POST['game'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $time = $_POST['time'];
    $school_id = $_POST['school_id'];
    $year = $_POST['year'];

    // Prepare the statement
    $count_query = mysqli_prepare($con, "SELECT COUNT(*) AS count FROM topers_list_web WHERE game_id = ?");
    mysqli_stmt_bind_param($count_query, "i", $game_id);
    mysqli_stmt_execute($count_query);
    $result = mysqli_stmt_get_result($count_query);
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];

    if ($count < 6) {
        $gender_count_query = mysqli_prepare($con, "SELECT COUNT(*) AS gender_count FROM topers_list_web WHERE game_id = ? AND gender = ?");
        mysqli_stmt_bind_param($gender_count_query, "is", $game_id, $gender);
        mysqli_stmt_execute($gender_count_query);
        $gender_result = mysqli_stmt_get_result($gender_count_query);
        $gender_row = mysqli_fetch_assoc($gender_result);
        $gender_count = $gender_row['gender_count'];

        if ($gender_count < 3) {
            // Insert the record using prepared statement
            $insert_query = mysqli_prepare($con, "INSERT INTO `topers_list_web`(`game_id`,`name`,`age`, `gender`, `time`, `year`, `school_id`) VALUES (?, ?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($insert_query, "issssss", $game_id, $name, $age, $gender, $time, $year,$school_id );
            $res_details = mysqli_stmt_execute($insert_query);

            if ($res_details) {
                echo "<script>alert('Data Inserted successfully!');</script>";
                echo "<script>window.location.href ='../toplist';</script>";
            } else {
                echo "Failed to insert product details." . $con->error;
            }
        } else {
            // Display an error message for exceeding the gender limit
            echo "<script>alert('Only three members of this gender are allowed for this game type.');</script>";
            echo "<script>window.location.href ='../toplist';</script>";
        }
    } else {
        // Display an error message for exceeding the overall limit
        echo "<script>alert('Only 6 members allowed for this game type.');</script>";
        echo "<script>window.location.href ='../toplist';</script>";
    }
}
?>
