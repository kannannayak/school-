<?php
include("../include/conn.php");

if(isset($_POST['submit'])){
    // Check if a file is uploaded
    if(isset($_FILES['slider_name']) && $_FILES['slider_name']['error'] == UPLOAD_ERR_OK){
        // Define the base URL where the file will be stored
        $base_url = "https://themithraa.com/RestApi/userApi/upload/sliders/";
        
        // Define the path where the file will be stored
        $slider_name_path = "../../../RestApi/userApi/upload/sliders/" . basename($_FILES['slider_name']['name']);
        
        // Move the uploaded file to the specified path
        if(move_uploaded_file($_FILES['slider_name']['tmp_name'], $slider_name_path)){
            // If file is uploaded successfully, set the file URL
            $slider_name_url = $base_url . basename($_FILES['slider_name']['name']);
        } else {
            // Handle the error if file upload fails
            $msg = 'File upload failed!';
            header("location:../slider_img?msg=$msg");
            exit();
        }
    } else {
        // Handle the error if no file is uploaded
        $msg = 'No file uploaded or file upload error!';
        header("location:../slider_img?msg=$msg");
        exit();
    }

    // Get camp_id from the form submission (assume it is passed via POST)
    $camp_id = isset($_POST['camp_id']) ? $_POST['camp_id'] : '';

    if(empty($camp_id)){
        $msg = 'Slider added successfully!';
        $sql = "INSERT INTO `images` (`images_name`) VALUES ('{$slider_name_url}')";
    } else {
        // Assuming you want to update the existing slider with camp_id
        $msg = 'Slider updated successfully!';
        $sql = "UPDATE `images` SET `images_name` = '{$slider_name_url}' WHERE `camp_id` = '{$camp_id}'";
    }

    // Execute the query
    $query = mysqli_query($conn, $sql);
    if($query){
        header("location:../slider_img?msg=$msg");
    } else {
        $msg = 'Database operation failed!';
        header("location:../slider_img?msg=$msg");
    }
}
?>
