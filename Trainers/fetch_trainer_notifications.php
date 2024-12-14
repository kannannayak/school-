<?php
include('include/conn.php');
session_start();

$id = $_SESSION['trainer_id'];
$result = mysqli_query($conn, "SELECT * FROM trainer_notification WHERE FIND_IN_SET('$id', trainer_id) ORDER BY tri_notifi_id DESC");

$notifications = array();
while ($row = mysqli_fetch_assoc($result)) {
    $notifications[] = $row;
}

echo json_encode($notifications);
?>
