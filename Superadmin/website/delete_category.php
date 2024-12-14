<?php
include('include/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the profileId parameter is provided
    if (isset($_POST['profileId'])) {
        $profileId = $_POST['profileId'];

        // Delete the retail user from the database
        $deleteQuery = "UPDATE `tbl_mst_product_category` SET cat_isdeleted = 1 WHERE cat_id = '$profileId'";
        $deleteResult = mysqli_query($con, $deleteQuery);

        if ($deleteResult) {
            // Deletion successful
            echo "success";
        } else {
            // Deletion failed
            echo "error";
        }
    }
}
?>
