<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../include/config.php');

if (isset($_POST['submit'])) {
    var_dump($_POST); // Debugging: Check if form data is being received

    $tut_name = $_POST['tut_name'];
    $tut_url = $_POST['tut_url'];
      $tut_details = $_POST['tut_details'];
      
    // $tutorial_web_id = isset($_POST['tutorial_web_id']) ? $_POST['tutorial_web_id'] : '';

    $tut_name = mysqli_real_escape_string($con, $tut_name);
    $tut_url = mysqli_real_escape_string($con, $tut_url);
      $tut_details = mysqli_real_escape_string($con, $tut_details);

    // $allowedImageExtensions = array('jpg', 'jpeg', 'png', 'gif');
    // $allowedVideoExtensions = array('mp4', 'avi', 'mov', 'wmv');
    // $uploadFolder = '../../upload/subcategory/';

    // if (!is_dir($uploadFolder)) {
    //     mkdir($uploadFolder, 0777, true);
    // }

    // // Image upload
    // $imageFilename = $_FILES['tutorial_web_image']['name'];
    // $imageTempFilePath = $_FILES['tutorial_web_image']['tmp_name'];
    // $imageExtension = strtolower(pathinfo($imageFilename, PATHINFO_EXTENSION));

    // // Video upload
    // $videoFilename = $_FILES['tutorial_source_file']['name'];
    // $videoTempFilePath = $_FILES['tutorial_source_file']['tmp_name'];
    // $videoExtension = strtolower(pathinfo($videoFilename, PATHINFO_EXTENSION));

    // if (in_array($imageExtension, $allowedImageExtensions) && in_array($videoExtension, $allowedVideoExtensions)) {
    //     $imageNewFilename = uniqid() . '.' . $imageExtension;
    //     $videoNewFilename = uniqid() . '.' . $videoExtension;

    //     $imageDestination = $uploadFolder . $imageNewFilename;
    //     $videoDestination = $uploadFolder . $videoNewFilename;

    //     if (move_uploaded_file($imageTempFilePath, $imageDestination) && move_uploaded_file($videoTempFilePath, $videoDestination)) {
    //         $imagePath = str_replace('../../', '', $imageDestination);
    //         $videoPath = str_replace('../../', '', $videoDestination);

    //         var_dump($imagePath, $videoPath, $tutorial_web_details, $tutorial_web_name); // Debugging: Check values before SQL query execution

            $sql = "INSERT INTO `tutorial` ( `tut_name`,`tut_url`,`tut_details`) VALUES ('$tut_name', '$tut_url','$tut_details')";

            if ($con->query($sql) === TRUE) {
                echo "<script>alert('Data Inserted successfully!');</script>";
                echo "<script>window.location.href ='../video_table';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $con->error;
            }
    //     } else {
    //         echo "Failed to move the uploaded files.";
    //     }
    // } else {
    //     echo "Invalid file extension for the uploaded image or video. Only jpg, jpeg, png, gif files are allowed for images and mp4, avi, mov, wmv files are allowed for videos.";
    // }
}
?>
