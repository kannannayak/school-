<?php
// Include the necessary configuration file and any other required files
include('../include/config.php');

// Check if the form is submitted
if(isset($_POST['submit'])){
    // Retrieve data from the form
    $image_id = $_POST['edit'];
    
    // Define the upload folder and allowed file extensions
    $uploadFolder = '../../upload/subcategory/';
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

    // Check if the upload folder exists, if not create it
    if (!is_dir($uploadFolder)) {
        mkdir($uploadFolder, 0777, true);
    }

    // Initialize variable for the image filename
    $image1 = '';

    // Check if an image is uploaded
    if ($_FILES['images_name']['name']) {
        $filename = $_FILES['images_name']['name'];
        $tempFilePath = $_FILES['images_name']['tmp_name'];
        $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Check if the file extension is allowed
        if (in_array($fileExtension, $allowedExtensions)) {
            // Generate a unique filename
            $newFilename = uniqid() . '.' . $fileExtension;
            $destination = $uploadFolder . $newFilename;

            // Move the uploaded file to the upload folder
            if (move_uploaded_file($tempFilePath, $destination)) {
                $image1 = str_replace('../../', '', $destination);
            } else {
                echo "Failed to move the uploaded file.";
                exit;
            }
        } else {
            echo "Invalid file extension for the uploaded image. Only jpg, jpeg, png, gif files are allowed.";
            exit;
        }
    }

    $sql = "UPDATE `image_web` SET `images_name`=? WHERE `image_id`=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("si", $image1, $image_id);
    $res = $stmt->execute();
    
    
    // Check if the query was successful
    if($res){
        echo "<script>alert('Data updated successfully!');</script>";
        echo "<script>window.location.href ='../table_img';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}
?>

<!-- Your HTML form goes here -->

<?php include('include/footer.php'); ?>
