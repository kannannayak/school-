<?php

// include("include/header.php");
include("../include/conn.php");

if(isset($_POST['submit'])){
    $school_name = str_replace("'","''", $_POST['school_name']);
    $school_location = str_replace("'","''", $_POST['school_location']);
    $school_id = $_POST['school_id'];

   

    $time_now=mktime(date('h')+3,date('i')+30,date('s'));
    $date = date('Y-m-d h:i:s', $time_now);

   

    if($camp_id == ''){                                                                                              
        $msg = 'Record added successfully!';
        $sql = "INSERT INTO `school_list`(`school_name`,`school_location`) VALUES ('{$school_name}','{$school_location}')";
    } else{
        $msg = 'Record Updated Successfully!';
        $sql = "UPDATE `school_list` SET `school_name`='{$school_name}',`school_location`='{$school_location}' WHERE `school_id`='$school_id'";
    }
            
    $query = mysqli_query($conn, $sql);
    if($query){
        header("location:../school?msg=$msg");
    }
    
    
}




?>