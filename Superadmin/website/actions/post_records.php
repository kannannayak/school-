<?php
include('../include/config.php');

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['submit'])) {
    $game = $_POST['game'];
    $name = $_POST['name'];
    $age_id = $_POST['age_id'];
    $gender_id = $_POST['gender_id'];
    $timing = $_POST['timing'];
    $country = $_POST['country'];
    $create_date = $_POST['create_date'];

    // Prepare the statement to count existing records for the game
    $count_query = mysqli_prepare($con, "SELECT COUNT(*) AS count FROM topers_list_web WHERE game_id = ?");
    mysqli_stmt_bind_param($count_query, "i", $game_id);
    mysqli_stmt_execute($count_query);
    $result = mysqli_stmt_get_result($count_query);
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];

    if ($count < 6) {
        // Insert the record using prepared statement
        $insert_query = mysqli_prepare($con, "INSERT INTO `website_record`(`game`,`name`,`age_id`, `gender_id`, `timing`, `create_date`, `country`) VALUES (?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($insert_query, "issssss", $game, $name, $age_id, $gender_id, $timing, $create_date, $country);
        $res_details = mysqli_stmt_execute($insert_query);

        if ($res_details) {
            echo "<script>alert('Data Inserted successfully!');</script>";
            echo "<script>window.location.href ='../records';</script>";
        } else {
            echo "Failed to insert product details: " . mysqli_error($con);
        }
    } else {
        // Display an error message for exceeding the overall limit
        echo "<script>alert('Only 6 members allowed for this game type.');</script>";
        echo "<script>window.location.href ='../records';</script>";
    }
}
?>

