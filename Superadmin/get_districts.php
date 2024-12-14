<?php
include("include/conn.php");

if(isset($_POST['state'])){
    $state_id = $_POST['state'];
    $result_district = mysqli_query($conn, "SELECT * FROM district WHERE state_id = $state_id");
    
    $districts = array();
    while($district_row = mysqli_fetch_assoc($result_district)){
        $districts[] = $district_row;
    }
    echo json_encode($districts);
}
?>
