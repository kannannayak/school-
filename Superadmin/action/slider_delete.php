<?php
include("../include/conn.php");

// Check if the necessary key is set in the $_GET array for driver notifications
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Construct and execute the delete SQL query for driver notifications
    $sql = "DELETE FROM `images` WHERE image_id = '$id'";
    $query = mysqli_query($conn, $sql);

    // Check if the delete query was successful for driver notifications
    if($query) {
        header("location: ../slider_img.php?msg=slider Deleted Successfully");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
        exit();
    }
} else {
    echo "No record ID provided";
    exit();
}
?>
<script>
    <?php
    if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        if ($msg != '') {
    ?>
            swal("", "<?php echo $msg; ?>", "success");
            if (window.history.replaceState) {
                window.history.replaceState({}, document.title, window.location.pathname);
            }
    <?php
        }
    }
    ?>
</script>
