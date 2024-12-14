<?php
include("../include/conn.php");

if (isset($_POST['submit'])) {
    
    // $trainer_id = $_POST['trainer_id'];
     $id = isset($_POST['id']) ? $_POST['id'] : null;
    $user_name = $_POST['user_name'];
    // $user_age = $_POST['user_age'];
    // $gender_name = $_POST['gender_name'];
    $parent_name = $_POST['parent_name'];
    $user_email = $_POST['user_email'];
    $user_mobile = $_POST['user_mobile'];
    $user_address = $_POST['user_address'];
    $district = $_POST['district'];
    $pincode = $_POST['pincode'];
    $school_name = $_POST['school_id'];
    $state_name = $_POST['state_id'];
    // $id_proof = $_POST['id_proof'];
    // $profile_pic = $_POST['profile_pic'];
    $confirm_password = $_POST['confirm_password'];
    // $ulog_id = $_POST['ulog_id'];
  

   
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
    $uploadFolder1 = 'upload/id_proof/';
  $uploadFolder2 = 'upload/profile_pic/';
  
  
    $filename = $_FILES['id_proof']['name'];
    $tempFilePath = $_FILES['id_proof']['tmp_name'];
    $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if (in_array($fileExtension, $allowedExtensions)) {
        $newFilename = uniqid() . '.' . $fileExtension;
        $destination1 = $uploadFolder1 . $newFilename;

         if (move_uploaded_file($tempFilePath, $destination1)) {
            $image1 = $uploadFolder1 . $newFilename;

            $filename2 = $_FILES['profile_pic']['name'];
            $tempFilePath2 = $_FILES['profile_pic']['tmp_name'];
            $fileExtension2 = strtolower(pathinfo($filename2, PATHINFO_EXTENSION));

            if (in_array($fileExtension2, $allowedExtensions)) {
                $newFilename2 = uniqid() . '.' . $fileExtension2;
                $destination2 =$uploadFolder2 . $newFilename2;

                if (move_uploaded_file($tempFilePath2, $destination2)) {
                    $image2 = $uploadFolder2 . $newFilename2;
                    
                    
                    // Prepare the SQL statement
$stmt = $conn->prepare("UPDATE users SET user_name=?, user_age=?, parent_name=?, user_email=?, user_mobile=?, user_address=?, district=?, pincode=?, school_id=?, state=?, confirm_password=?, id_proof=?, profile_pic=? WHERE user_id=?");

// Bind parameters
$stmt->bind_param("sisssississssi", $user_name, $user_age, $parent_name, $user_email, $user_mobile, $user_address, $district, $pincode, $school_id, $state, $confirm_password, $image1, $image2, $id);

// Execute the statement
$stmt->execute();

 
              if($stmt->execute()) {
                              echo "<script>alert('Details updated successfully');</script>";

                 echo "<script>window.location.href ='../student_list';</script>";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                } else {
                    echo "Failed to move the uploaded proof file.";
                }
            } else {
                echo "Invalid file extension for the uploaded proof file. Only jpg, jpeg, png, gif files are allowed.";
            }
        } else {
            echo "Failed to move the uploaded image file.";
        }
    } else {
        echo "Invalid file extension for the uploaded image file. Only jpg, jpeg, png, gif files are allowed.";
    }
}
?>
