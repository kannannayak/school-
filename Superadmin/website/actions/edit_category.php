<?php
include('../include/config.php');

if(isset($_POST['submit'])){
    $category_name = $_POST['cat_name'];
    $category_desc = $_POST['cat_desc'];
    $category_id = $_POST['cat_id'];
    $uploadFolder = '../../upload/category/';
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

    if (!is_dir($uploadFolder)) {
        mkdir($uploadFolder, 0777, true);
    }

    $image1 = '';

    if ($_FILES['image1']['name']) {
        $filename = $_FILES['image1']['name'];
        $tempFilePath = $_FILES['image1']['tmp_name'];
        $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($fileExtension, $allowedExtensions)) {
            $newFilename = uniqid() . '.' . $fileExtension;
            $destination = $uploadFolder . $newFilename;

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

    $sql = "UPDATE `tbl_mst_product_category` SET `cat_name`='$category_name', `cat_description`='$category_desc'";

    if (!empty($image1)) {
        $sql .= ", `cat_img`='$image1'";
    }

    $sql .= " WHERE `cat_id`='$category_id'";

    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Data updated successfully!');</script>";
        echo "<script>window.location.href ='../category';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}
?>
