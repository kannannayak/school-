<?php

include("../include/header.php");
include("../include/conn.php");

// Assuming $connnection is your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name=$_SESSION['trainer_id'];
    $trainer_name = $_POST['new_name'];
    $old_image = $_POST['old_image'];

    $uploadFolder = 'upload/';
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
    $filename = $_FILES['trainer_img']['name'];

    if(empty($filename)){
        $image1=$old_image;
    }else{
        $tempFilePath = $_FILES['trainer_img']['tmp_name'];
        $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
       
        if (in_array($fileExtension, $allowedExtensions)) {
            $newFilename = uniqid() . '.' . $fileExtension;
            $destination = "../" . $uploadFolder.$newFilename;
    
            // Move the uploaded file to the desired directory
            if (move_uploaded_file($tempFilePath, $destination)) 
            {
                $image1 = $uploadFolder . $newFilename;
                
                } else {
                    echo "Error in prepared statement: " . mysqli_error($conn);
                }
            } else {
                echo "Error moving uploaded image to destination directory.";
            }
        
    }
    $query = "UPDATE trainer SET trainer_img = ? ,  trainer_name = ? WHERE trainer_id = ? ";
                $stmt = mysqli_prepare($conn, $query);
    
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "ssi", $image1 , $trainer_name,$name);
                    mysqli_stmt_execute($stmt);
    
                    // Check if the database update was successful
                    if (mysqli_stmt_affected_rows($stmt) > 0) {
                        $_SESSION['trainer_img'] = $image1;
                        $_SESSION['trainer_name'] = $trainer_name;
                        echo "<script>alert('Image updated successfully.');</script>";
                        echo "<script>window.location.href ='../profile.php';</script>";
                        exit();
                    } else {
                        echo "Error updating image in database.";
                    }
                    
    
                    mysqli_stmt_close($stmt);
    
} else {
    echo "Invalid request.";
}
}
// ob_end_flush(); 
?>
