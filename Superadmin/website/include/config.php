<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$con =new mysqli('localhost', 'u892124399_Mithraateckzy3', '$Mithr@564589', 'u892124399_Mithraateckzy3');

if ($con->connect_error) {

    echo "error to MYSQL(".$con->error.")".($con->error);
    echo "changes done";
} else{
    //  echo "done connected";
}
?>

