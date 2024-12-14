<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../include/config.php');

if (isset($_POST['submit'])) {
    
    // Debugging: Check if form data is being received
function extractYouTubeLink($iframe) {
    preg_match('/src="([^"]+)"/', $iframe, $matches);
    if (isset($matches[1])) {
        return $matches[1];
    } else {
        echo "Error: No video link found in the iframe: $iframe";
        return '';
    }
}

// Get POST data
$tutorial_web_id = $_POST['edit'];
$tutorial_web_name = $_POST['tutorial_web_name'];
$tutorial_web_details = $_POST['tutorial_web_details'];
$tutorial_web_url = $_POST['tutorial_web_url'];  // Correctly fetch the iframe data

// Escape input data to prevent SQL injection
$tutorial_web_id = mysqli_real_escape_string($con, $tutorial_web_id);
$tutorial_web_name = mysqli_real_escape_string($con, $tutorial_web_name);
$tutorial_web_details = mysqli_real_escape_string($con, $tutorial_web_details);
// $tutorial_web_url = mysqli_real_escape_string($con, $tutorial_web_url);

// Extract the link from the iframe
$video_web = extractYouTubeLink($tutorial_web_url);

// Check if extraction was successful
// if ($video_web == '') {
//     echo "Error: Unable to extract video link from the iframe.";
//     exit;
// }
// exit();

    // Check if a new image file is uploaded
    // if ($_FILES['tutorial_web_image']['size'] > 0) {
    //     $imageFilename = $_FILES['tutorial_web_image']['name'];
    //     $imageTempFilePath = $_FILES['tutorial_web_image']['tmp_name'];
    //     $imageExtension = strtolower(pathinfo($imageFilename, PATHINFO_EXTENSION));

    //     // Only allow certain image extensions
    //     $allowedImageExtensions = array('jpg', 'jpeg', 'png', 'gif');

        // Check if the uploaded image has a valid extension
    //     if (in_array($imageExtension, $allowedImageExtensions)) {
    //         $imageNewFilename = uniqid() . '.' . $imageExtension;
    //         $imageDestination = '../../upload/subcategory/' . $imageNewFilename;

          
    //         if (move_uploaded_file($imageTempFilePath, $imageDestination)) {
    //             $imagePath = str_replace('../../', '', $imageDestination);
    //         } else {
    //             echo "Failed to move the uploaded image file.";
    //         }
    //     } else {
    //         echo "Invalid file extension for the uploaded image. Only jpg, jpeg, png, gif files are allowed.";
    //     }
    // }

    // // Check if a new video file is uploaded
    // if ($_FILES['tutorial_source_file']['size'] > 0) {
    //     $videoFilename = $_FILES['tutorial_source_file']['name'];
    //     $videoTempFilePath = $_FILES['tutorial_source_file']['tmp_name'];
    //     $videoExtension = strtolower(pathinfo($videoFilename, PATHINFO_EXTENSION));

    //     // Only allow certain video extensions
    //     $allowedVideoExtensions = array('mp4', 'avi', 'mov', 'wmv');

    //     // Check if the uploaded video has a valid extension
    //     if (in_array($videoExtension, $allowedVideoExtensions)) {
    //         $videoNewFilename = uniqid() . '.' . $videoExtension;
    //         $videoDestination = '../../upload/subcategory/' . $videoNewFilename;

    //         // Move the uploaded video file to the destination folder
    //         if (move_uploaded_file($videoTempFilePath, $videoDestination)) {
    //             $videoPath = str_replace('../../', '', $videoDestination);
    //         } else {
    //             echo "Failed to move the uploaded video file.";
    //         }
    //     } else {
    //         echo "Invalid file extension for the uploaded video. Only mp4, avi, mov, wmv files are allowed.";
    //     }
    // }

    // Check if either image or video file is uploaded
    // if (isset($imagePath) || isset($videoPath)) {
    //     // Update the database with the new image or video path
    //     $sql = "UPDATE `tutorial_web` SET ";
    //     if (isset($imagePath)) {
    //         $sql .= "`tutorial_web_image` = '$imagePath', ";
    //     }
    //     if (isset($videoPath)) {
    //         $sql .= "`tutorial_source_file` = '$videoPath', ";
    //     }
        // Append other fields to the query
      $sql = "UPDATE `tutorial_web` SET `tutorial_web_details` = '$tutorial_web_details', `tutorial_web_name` = '$tutorial_web_name', `tutorial_web_url` = '$tutorial_web_url',`video_web`='$video_web' WHERE `tutorial_web_id` = '$tutorial_web_id'";
        // Debugging: Check generated SQL query
        // var_dump($sql);

        // Execute the SQL query
        if ($con->query($sql) === TRUE) {
            echo "<script>alert('Data Update successfully!');</script>";
            echo "<script>window.location.href ='../table_tutorial';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    // } else {
    //     echo "No new image or video file uploaded. No changes made.";
    // }
}
?>
