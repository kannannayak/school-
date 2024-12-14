<?php
include("../include/conn.php");

if (isset($_POST['submit'])) {
    
    // $trainer_id = $_POST['trainer_id'];

    $trainer_name = $_POST['trainer_name'];
    $trainer_mobile = $_POST['trainer_mobile'];
    $trainer_email = $_POST['trainer_email'];
    $trainer_dob = $_POST['trainer_dob'];
    $trainer_school = $_POST['trainer_school'];
    $trainer_address = $_POST['trainer_address'];
    $district = $_POST['district'];
    $trainer_state = $_POST['trainer_state'];
    $pincode = $_POST['pincode'];
    $tlog_pass = $_POST['tlog_pass'];
    
    // $trainer_unique_id = 'TRI' . date('dmy') . date('His');

$random_number = mt_rand(1000, 9999); // Random 3-digit number
$trainer_unique_id = 'TRI' . $random_number;




    $tlog_id  = mysqli_real_escape_string($conn, $trainer_unique_id);
    $trainer_name  = mysqli_real_escape_string($conn, $trainer_name);
    $trainer_mobile  = mysqli_real_escape_string($conn, $trainer_mobile);
    $trainer_email  = mysqli_real_escape_string($conn, $trainer_email);
    $trainer_dob  = mysqli_real_escape_string($conn, $trainer_dob);
    $trainer_school  = mysqli_real_escape_string($conn, $trainer_school);
    $trainer_address  = mysqli_real_escape_string($conn, $trainer_address);
    $district  = mysqli_real_escape_string($conn, $district);
    $trainer_state  = mysqli_real_escape_string($conn, $trainer_state);
    $pincode  = mysqli_real_escape_string($conn, $pincode);
    $tlog_pass  = mysqli_real_escape_string($conn, $tlog_pass);
   
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
    $uploadFolder = 'upload/';

    $filename = $_FILES['trainer_img']['name'];
    $tempFilePath = $_FILES['trainer_img']['tmp_name'];
    $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if (in_array($fileExtension, $allowedExtensions)) {
        $newFilename = uniqid() . '.' . $fileExtension;
        $destination = '../'.$uploadFolder . $newFilename;

        

        

        if (move_uploaded_file($tempFilePath, $destination)) {
            $image1 = $uploadFolder . $newFilename;

            $filename2 = $_FILES['trainer_id_proof']['name'];
            $tempFilePath2 = $_FILES['trainer_id_proof']['tmp_name'];
            $fileExtension2 = strtolower(pathinfo($filename2, PATHINFO_EXTENSION));

            if (in_array($fileExtension2, $allowedExtensions)) {
                $newFilename2 = uniqid() . '.' . $fileExtension2;
                $destination2 = '../'.$uploadFolder . $newFilename2;

                if (move_uploaded_file($tempFilePath2, $destination2)) {
                    $image2 = $uploadFolder . $newFilename2;
                    $sql = "INSERT INTO `trainer` (`trainer_name`, `trainer_email`, `trainer_dob`, `trainer_mobile`, `trainer_address`, `tlog_id`, `tlog_pass`, `district`, `trainer_state`, `pincode`, `school_id`, `trainer_id_proof`, `trainer_img`)
                    VALUES ('$trainer_name', '$trainer_email', '$trainer_dob', '$trainer_mobile', '$trainer_address', '$trainer_unique_id', '$tlog_pass', '$district', '$trainer_state', '$pincode', '$trainer_school', '$image2', '$image2')";
                if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('Your application has been submitted successfully and is waiting for admin approval or rejection. You will receive a confirmation email.');</script>";
                        echo "<script>window.location.href ='../register.php';</script>";
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
