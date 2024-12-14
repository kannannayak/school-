<?php
include('include/conn.php');

if (isset($_POST['notification_ids'])) {
    $notification_ids = $_POST['notification_ids'];
    $ids = implode(',', array_map('intval', $notification_ids));

    $update_query = "UPDATE trainer_notification SET is_read = 1 WHERE tri_notifi_id IN ($ids)";
    if (mysqli_query($conn, $update_query)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to mark as read']);
    }
}
?>
