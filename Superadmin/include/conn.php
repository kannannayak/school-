<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn =new mysqli('localhost', 'u892124399_Mithraateckzy3', '$Mithr@564589', 'u892124399_Mithraateckzy3');

if ($conn->connect_error) {

    echo "error to MYSQL(".$conn->error.")".($conn->error);
    echo "changes done";
} else{
    //  echo "done connected";
}
?>

