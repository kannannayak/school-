<?php
include("../include/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve selected values from the form
    $selectedtrainerId = $_POST['trainer'];
    $selectedstudentIds = isset($_POST['student']) ? $_POST['student'] : array();
    

    // Concatenate the IDs into a comma-separated string
    $studentIdsString = implode(',', $selectedstudentIds);


    $ass_id = $_POST['ass_id'];

    if (!empty($ass_id)) {
        // Update existing assignment
        $msg = "Trainer Assignment Updated Successfully";

        $sqlUpdate = "UPDATE `assign_students` 
                      SET `trainer_id`='$selectedtrainerId', 
                          `students_id`='$studentIdsString', 
                          
                      WHERE `ass_id`='$ass_id'";

        
    } else {
        // Insert new assignment
        $msg = "Trainer Assigned Successfully";

        $sqlInsert = "INSERT INTO `assign_students` (trainer_id, students_id) 
                      VALUES ('$selectedtrainerId', '$studentIdsString')";

        if ($conn->query($sqlInsert) === TRUE) {
            header("location: ../ass_coord?msg=$msg");
            exit;
        } else {
            echo "Error inserting new record into assign_coord: " . $conn->error;
        }
    }
}
?>
