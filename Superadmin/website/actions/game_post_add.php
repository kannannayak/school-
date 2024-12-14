<?php
include('../include/config.php');

if (isset($_POST['submit'])) {
    $game_type_name = $_POST['game_type_name'];
   

    $game_type_name  = mysqli_real_escape_string($con,  $game_type_name );
   
    // $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
    // $uploadFolder = '../../upload/subcategory/';

    // if (!is_dir($uploadFolder)) {
    //     mkdir($uploadFolder, 0777, true);
    // }

    // $filename = $_FILES['game_type_img']['name'];
    // $tempFilePath = $_FILES['game_type_img']['tmp_name'];
    // $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    // if (in_array($fileExtension, $allowedExtensions)) {
    //     $newFilename = uniqid() . '.' . $fileExtension;
    //     $destination = $uploadFolder . $newFilename;

    //     if (move_uploaded_file($tempFilePath, $destination)) {
    //         $image1 = str_replace('../../', '', $destination);

            $sql = "INSERT INTO `game_type_web` ( `game_type_name`,`game_type_img`) VALUES ('$game_type_name', '$image1')";

            if ($con->query($sql) === TRUE) {
                echo "<script>alert('Data Inserted successfully!');</script>";
                echo "<script>window.location.href ='../table_game';</script>";
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
