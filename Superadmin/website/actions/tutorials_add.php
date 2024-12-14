<?php
include('../include/config.php');

if (isset($_POST['submit'])) {
    $tutorial_web_name = $_POST['tutorial_web_name'];
    $tutorial_web_details = $_POST['tutorial_web_details'];
    $tutorial_web_url = $_POST['tutorial_web_url'];
    // $video_web = $_POST['tutorial_web_url'];
    //   $video_web = $_POST['video_web'];
      
      function extractYouTubeLink($iframe) {
    preg_match('/src="([^"]+)"/', $iframe, $matches);
    if (isset($matches[1])) {
        return $matches[1];
    }
    return '';
}
  date_default_timezone_set('Asia/Kolkata');
    $current_time = date('Y-m-d h:i:s A');



// Assuming you have received the iframe code in a variable $iframe
// $iframe = '<iframe width="560" height="315" src="https://www.youtube.com/embed/VIDEO_ID" frameborder="0" allowfullscreen></iframe>';

// Extract the link from the iframe
$video_web = extractYouTubeLink($tutorial_web_url);

    $tutorial_web_name   = mysqli_real_escape_string($con,  $tutorial_web_name );
    $tutorial_web_details   = mysqli_real_escape_string($con,  $tutorial_web_details );
    $tutorial_web_url   = mysqli_real_escape_string($con,  $tutorial_web_url );
      $video_web   = mysqli_real_escape_string($con,  $video_web );
   
    // $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
    // $uploadFolder = '../../upload/subcategory/';

    // if (!is_dir($uploadFolder)) {
    //     mkdir($uploadFolder, 0777, true);
    // }

    // $filename = $_FILES['tutorial_web_image']['name'];
    // $tempFilePath = $_FILES['tutorial_web_image']['tmp_name'];
    // $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    // if (in_array($fileExtension, $allowedExtensions)) {
    //     $newFilename = uniqid() . '.' . $fileExtension;
    //     $destination = $uploadFolder . $newFilename;

    //     if (move_uploaded_file($tempFilePath, $destination)) {
    //         $image1 = str_replace('../../', '', $destination);

            $sql = "INSERT INTO `tutorial_web` ( `tutorial_web_name`,`tutorial_web_image`,`tutorial_web_details`,`tutorial_web_url`,`video_web`,`tutorial_web_created`) VALUES ('$tutorial_web_name', '$image1','$tutorial_web_details','$tutorial_web_url','$video_web','$current_time')";

            if ($con->query($sql) === TRUE) {
                echo "<script>alert('Data Inserted successfully!');</script>";
                echo "<script>window.location.href ='../table_tutorial';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $con->error;
            }
    //     } else {
    //         echo "Failed to move the uploaded file.";
    //     }
    // } else {
    //     echo "Invalid file extension for the uploaded image. Only jpg, jpeg, png, gif files are allowed.";
    // }
}
?>
