<?php
include('../include/config.php');

if (isset($_POST['submit'])) {
    $news_name = $_POST['news_name'];
    $news_url = $_POST['news_url'];
    $news_details = $_POST['news_details'];
   

    $news_name  = mysqli_real_escape_string($con,  $news_name );
    $news_url  = mysqli_real_escape_string($con,  $news_url );
    $news_details  = mysqli_real_escape_string($con,  $news_details );
   
    // $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
    // $uploadFolder = '../../upload/subcategory/';

    // if (!is_dir($uploadFolder)) {
    //     mkdir($uploadFolder, 0777, true);
    // }

    // $filename = $_FILES['news_image']['name'];
    // $tempFilePath = $_FILES['news_image']['tmp_name'];
    // $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    // if (in_array($fileExtension, $allowedExtensions)) {
    //     $newFilename = uniqid() . '.' . $fileExtension;
    //     $destination = $uploadFolder . $newFilename;

    //     if (move_uploaded_file($tempFilePath, $destination)) {
    //         $image1 = str_replace('../../', '', $destination);

            $sql = "INSERT INTO `news` ( `news_name`,`news_image`,`news_url`,`news_details`) VALUES ('$news_name', '$image1','$news_url','$news_details')";

            if ($con->query($sql) === TRUE) {
                echo "<script>alert('Data Inserted successfully!');</script>";
                echo "<script>window.location.href ='../table_news';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $con->error;
            }
        // } else {
        //     echo "Failed to move the uploaded file.";
        // }
    // } else {
    //     echo "Invalid file extension for the uploaded image. Only jpg, jpeg, png, gif files are allowed.";
    // }
}
?>
