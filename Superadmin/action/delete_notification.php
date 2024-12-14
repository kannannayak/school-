<?php
include("../include/conn.php");

// Check if the necessary key is set in the $_GET array for driver notifications
if(isset($_GET['notifi_id'])) {
    $id1 = $_GET['notifi_id'];

    // Construct and execute the delete SQL query for driver notifications
    $sql1 = "DELETE FROM `notification` WHERE notifi_id = '$id1'";
    $query1 = mysqli_query($conn, $sql1);

    // Check if the delete query was successful for driver notifications
    if($query1) {
        header("location: ../sent_notification.php?msg=Record Deleted Successfully");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
        exit;
    }
} 

// Check if the necessary key is set in the $_GET array for coordinator notifications
if(isset($_GET['tri_notifi_id'])) {
    $id2 = $_GET['tri_notifi_id'];

    // Construct and execute the delete SQL query for coordinator notifications
    $sql2 = "DELETE FROM  trainer_notification WHERE tri_notifi_id = '$id2'";
    $query2 = mysqli_query($conn, $sql2);

    // Check if the delete query was successful for coordinator notifications
    if($query2) {
        header("location: ../sent_notification.php?msg=Record Deleted Successfully");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
        exit;
    }
} 


// Check if the necessary key is set in the $_GET array for coordinator notifications


echo "No record ID provided";
exit;
?>
<script>
    <?php
    $msg = $_GET['msg'];
    if ($msg != '') {
    ?>
        swal("", "<?php echo $msg; ?>", "success");
        if (window.history.replaceState) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    <?php
    }
    ?>
</script>