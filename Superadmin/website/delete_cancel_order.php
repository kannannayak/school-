<?php
include('include/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the profileId parameter is provided
    if (isset($_POST['profileId'])) {
        $profileId = $_POST['profileId'];

        // Delete the retail user from the database
        $deleteQuery = "UPDATE `tbl_mst_order_cancelled_details` SET can_order_items_isdeleted = 1 WHERE can_order_id = '$profileId'";
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
