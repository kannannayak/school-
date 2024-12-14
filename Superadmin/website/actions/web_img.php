<?php
include('../include/config.php');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (isset($_POST['submit'])) {
  
   
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
    $uploadFolder = '../../upload/subcategory/';

    if (!is_dir($uploadFolder)) {
        mkdir($uploadFolder, 0777, true);
    }

    $filename = $_FILES['web_img']['name'];
    $tempFilePath = $_FILES['web_img']['tmp_name'];
    $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if (in_array($fileExtension, $allowedExtensions)) {
        $newFilename = uniqid() . '.' . $fileExtension;
        $destination = $uploadFolder . $newFilename;

        if (move_uploaded_file($tempFilePath, $destination)) {
            $image1 = str_replace('../../', '', $destination);

            $sql = "INSERT INTO `web_slider_img` ( `web_img`) VALUES ('$image1')";

            if ($con->query($sql) === TRUE) {
                echo "<script>alert('Data Inserted successfully!');</script>";
                echo "<script>window.location.href ='../sliders';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $con->error;
            }
        } else {
            echo "Failed to move the uploaded file.";
        }
    } else {
        echo "Invalid file extension for the uploaded image. Only jpg, jpeg, png, gif files are allowed.";
    }
}
?>