
<?php
include('include/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $deleteQuery = "DELETE FROM registerform WHERE id = '$id'";
        $deleteResult = mysqli_query($con, $deleteQuery);

        if ($deleteResult) {
            echo "success";
        } else {
            echo "error";
        }
    }
}
?>
