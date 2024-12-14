<?php
include('include/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tourn_id'])) {
        $tourn_id = $_POST['tourn_id'];

        $deleteQuery = "DELETE FROM tournament WHERE tourn_id = '$tourn_id' ";
        $deleteResult = mysqli_query($con, $deleteQuery);

        if ($deleteResult) {
            echo "success";
        } else {
            echo "error";
        }
    }
}
?>
