
<?php
include('include/conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $deleteQuery = "DELETE FROM notification WHERE notifi_id = '$id'";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if ($deleteResult) {
            echo "success";
        } else {
            echo "error";
        }
    }
}
?>
