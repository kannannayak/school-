<?php
include('../include/config.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all necessary fields are set
    if(isset($_POST['id'],$_POST['game'], $_POST['name'], $_POST['age'], $_POST['gender'], $_POST['time'], $_POST['year'], $_POST['school_id'])) {
        // Sanitize input data
        $toper_id = $_POST['id'];
        $game_id=$_POST['game'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $time = $_POST['time'];
        $school_id = $_POST['school_id'];
        $year = $_POST['year'];

        $count_query = mysqli_query($con, "SELECT COUNT(*) AS count FROM topers_list_web WHERE game_id = $game_id");
        $row = mysqli_fetch_assoc($count_query);
        $count = $row['count'];
        if ($count < 6) {
            $stmt = $con->prepare("UPDATE `topers_list_web` SET game_id=?, name=?, age=?, gender=?, time=?, year=?, school_id=? WHERE toper_id=?");
            $stmt->bind_param("isssssi", $game_id, $name, $age, $gender, $time, $year, $toper_id, $school_id);
    
            if($stmt->execute()) {
                echo "Record updated successfully";
                 echo "<script>window.location.href ='../toplist';</script>";
            } else {
                echo "Error updating record: " . $stmt->error;
            }
        } else {
          
            echo "<script>alert('Error: Only 5 members allowed for this game type.');</script>";
             echo "<script>window.location.href ='../toplist';</script>";
        }
    } else {
        // Display an error message
        echo "All fields are required.";
    }
} else {
    echo "Invalid request.";
}
?>
