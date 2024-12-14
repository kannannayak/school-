<?php
// Include the necessary configuration file and any other required files
include('../include/config.php');
// Check if the form is submitted
if(isset($_POST['submit'])){
    // Retrieve data from the form
    $news_id = $_POST['edit'];
    $news_name = $_POST['news_name'];
    $news_url = $_POST['news_url'];
    $news_details = $_POST['news_details'];

    // Sanitize user input to prevent SQL injection
    $news_id  = mysqli_real_escape_string($con, $news_id);
    $news_name  = mysqli_real_escape_string($con, $news_name);
    $news_url  = mysqli_real_escape_string($con, $news_url);
    $news_details  = mysqli_real_escape_string($con, $news_details);

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
    if ($_FILES['news_image']['name']) {
        $filename = $_FILES['news_image']['name'];
        $tempFilePath = $_FILES['news_image']['tmp_name'];
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

    // Build the SQL query to update the record
    $sql = "UPDATE `news` SET `news_name`='$news_name',`news_image`='$image1' ,`news_url`='$news_url',`news_details`='$news_details' WHERE`news_id`='$news_id'";

    // Append image filename to the SQL query if an image is uploaded
    // if (!empty($image1)) {
    //     $sql .= ", `news_image`='$image1'";
    // }

    // $sql .= " WHERE `news_id`='$news_id'";

    // Execute the SQL query
    $res = mysqli_query($con, $sql);
    
    // Check if the query was successful
    if($res){
        echo "<script>alert('Data updated successfully!');</script>";
        echo "<script>window.location.href ='../table_news';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}
?>

<!-- Your HTML form goes here -->

<?php include('include/footer.php'); ?>