<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../include/config.php');

if (isset($_POST['submit'])) {
    // Debugging: Check if form data is being received
    var_dump($_POST);

    $tut_id = $_POST['edit'];
    $tut_name = $_POST['tut_name'];
  $tut_url = $_POST['tut_url'];
   $tut_details = $_POST['tut_details'];

  $tut_name = mysqli_real_escape_string($con, $tut_name);
    $tut_url = mysqli_real_escape_string($con, $tut_url);
       
       $tut_details = mysqli_real_escape_string($con, $tut_details);
  

    

   
      $sql = "UPDATE `tutorial` SET `tut_name` = '$tut_name', `tut_url` = '$tut_url' ,`tut_details`='$tut_details' WHERE `tut_id` = '$tut_id'";
        // Debugging: Check generated SQL query
        var_dump($sql);

        // Execute the SQL query
        if ($con->query($sql) === TRUE) {
            echo "<script>alert('Data Inserted successfully!');</script>";
            echo "<script>window.location.href ='../video_table';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    // } else {
    //     echo "No new image or video file uploaded. No changes made.";
    // }
}
?>
