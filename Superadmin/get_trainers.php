<?php
include("include/conn.php");

if (isset($_POST['school'])) {
    $school_id = $_POST['school'];

    $sql = "SELECT * FROM trainer WHERE school_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $school_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $trainers = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $trainers[] = $row;
    }

    echo json_encode($trainers);
}
?>
