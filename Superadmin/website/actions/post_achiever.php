<?php
include('../include/config.php');

if (isset($_POST['update_profile'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $location = $_POST['location'];
    $game = $_POST['game'];
    $timing = $_POST['timing'];

    // Ensure all required fields are provided
    if (empty($name) || empty($age) || empty($location) || empty($game) || empty($timing)) {
        echo "<script>alert('All fields are required.');</script>";
        echo "<script>window.location.href ='../achievers';</script>";
        exit;
    }

    // Handle the image upload
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
    $uploadFolder = '../../upload/achievers/';

    if (!is_dir($uploadFolder)) {
        mkdir($uploadFolder, 0777, true);
    }

    $filename = $_FILES['image']['name'];
    $tempFilePath = $_FILES['image']['tmp_name'];
    $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if (in_array($fileExtension, $allowedExtensions)) {
        $newFilename = uniqid() . '.' . $fileExtension;
        $destination = $uploadFolder . $newFilename;

        if (move_uploaded_file($tempFilePath, $destination)) {
            $image1 = str_replace('../../', '', $destination);

            // Insert the Achiever data into the database
            $sql = "INSERT INTO `achievers` (`name`, `age`, `location`, `image`, `game`, `timing`) VALUES ('$name', '$age', '$location', '$image1', '$game', '$timing')";
            $res_details = mysqli_query($con, $sql);

            if ($res_details) {
                echo "<script>alert('Data inserted successfully!');</script>";
                echo "<script>window.location.href ='../achievers';</script>";
            } else {
                echo "Failed to insert achiever details: " . mysqli_error($con);
            }
        } else {
            echo "<script>alert('Failed to upload image.');</script>";
            echo "<script>window.location.href ='../achievers';</script>";
        }
    } else {
        echo "<script>alert('Invalid file extension.');</script>";
        echo "<script>window.location.href ='../achievers';</script>";
    }
}

// Close the database connection
mysqli_close($con);
?>
