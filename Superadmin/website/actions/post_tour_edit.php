<?php
// Include the necessary configuration file and any other required files
include('../include/config.php');

// Check if the form is submitted
if(isset($_POST['submit'])){
    // Retrieve data from the form
    $tourn_id = $_POST['edit'];
    $tourn_type = $_POST['tourn_type'];
    $game_type = $_POST['game_type'];
    $tourn_name = $_POST['tourn_name'];
    $tourn_date = $_POST['tourn_date']; // Expected to be in dd-mm-yyyy format
    $tourn_details = $_POST['tourn_details'];
    $tourn_url = $_POST['tourn_url'];
    
    // $tourn_desc = $_POST['tourn_desc'];
  $tourn_desc = $_POST['tourn_desc'];
    // Sanitize user input to prevent SQL injection
    $tourn_type = mysqli_real_escape_string($con, $tourn_type);
    $game_type = mysqli_real_escape_string($con, $game_type);
    $tourn_name = mysqli_real_escape_string($con, $tourn_name);
    $tourn_date = mysqli_real_escape_string($con, $tourn_date);
    $tourn_details = mysqli_real_escape_string($con, $tourn_details);
    $tourn_url = mysqli_real_escape_string($con, $tourn_url);
    // $tourn_desc = mysqli_real_escape_string($con, $tourn_desc);
    if (strlen($tourn_desc) > 600) {
        echo "<script>alert('Character count exceeded 600');</script>";
        echo "<script>window.location.href ='../table_tournament';</script>";
    } else {    
    $imagePath = ''; // default value
    
    if ($_FILES['tourn_image']['size'] > 0) {
        $imageFilename = $_FILES['tourn_image']['name'];
        $imageTempFilePath = $_FILES['tourn_image']['tmp_name'];
        $imageExtension = strtolower(pathinfo($imageFilename, PATHINFO_EXTENSION));

        // Only allow certain image extensions
        $allowedImageExtensions = array('jpg', 'jpeg', 'png', 'gif');

        // Check if the uploaded image has a valid extension
        if (in_array($imageExtension, $allowedImageExtensions)) {
            $imageNewFilename = uniqid().'.'.$imageExtension;
            $imageDestination = '../../upload/subcategory/'.$imageNewFilename;

            if (move_uploaded_file($imageTempFilePath, $imageDestination)) {
                $imagePath = str_replace('../../', '', $imageDestination);
            } else {
                echo "<script>alert('Failed to move the uploaded image file.');</script>";
            }
        } else {
            echo "<script>alert('Invalid file extension for the uploaded image. Only jpg, jpeg, png, gif files are allowed.');</script>";
        }
    } else {
        // Get the old image name from the database
        $sql = "SELECT `tourn_image` FROM `tournament` WHERE `tourn_id`=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $tourn_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $imagePath = $row['tourn_image'];
    }

    // Prepare SQL statement to update the record
    $sql = "UPDATE `tournament` SET `tourn_type`=?, `game_type`=?, `tourn_name`=?, `tourn_date`=?, `tourn_desc`=?, `tourn_image`=?, `tourn_details`=?, `tourn_url`=? WHERE `tourn_id`=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssssssi", $tourn_type, $game_type, $tourn_name, $tourn_date, $tourn_desc, $imagePath, $tourn_details, $tourn_url, $tourn_id);
    $res = $stmt->execute();

    // Check if the query was successful
    if($res){
        echo "<script>alert('Data updated successfully!');</script>";
        echo "<script>window.location.href ='../table_tournament';</script>";
    } else {
        echo "<script>alert('Error: ". $stmt->error. "');</script>";
    }
}} else {
    echo "<script>alert('No new image or video file uploaded. No changes made.');</script>";
}
?>
