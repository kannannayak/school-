<?php
include("include/config.php");

if(isset($_POST['term_submit'])){

    $term_description = $_POST['terms'];

$cat_upt= "UPDATE `info` SET `terms`='$term_description' ";

 $cat_upt_qry=mysqli_query($con,$cat_upt);
 if($cat_upt_qry==true){
    header('location:terms');
 }else{
    echo"not success ";
 }
}
if(isset($_POST['policy_submit'])){

    $privacydescription = $_POST['privacy'];

$cat_upt= "UPDATE `info` SET `rules`='$privacydescription' ";

// print_r($cat_upt);exit;
 $cat_upt_qry=mysqli_query($con,$cat_upt);
 if($cat_upt_qry==true){
    header('location:privacy_policy');
 }else{
    echo"not success ";
 }
}
if(isset($_POST['about_submit'])){

    $aboutdescription = $_POST['about'];

$cat_upt= "UPDATE `info` SET `about`='$aboutdescription' ";

// print_r($cat_upt);exit;
 $cat_upt_qry=mysqli_query($con,$cat_upt);
 if($cat_upt_qry==true){
    header('location:about_us');
 }else{
    echo"not success ";
 }
}
if(isset($_POST['care_submit'])){

    $aboutdescription = $_POST['customer_care'];

$cat_upt= "UPDATE `info` SET `customer_care`='$aboutdescription' ";

// print_r($cat_upt);exit;
 $cat_upt_qry=mysqli_query($con,$cat_upt);
 if($cat_upt_qry==true){
    header('location:customer_care');
 }else{
    echo"not success ";
 }
}
if(isset($_POST['privacy_submit'])){

    $shipping = $_POST['privacy'];

$cat_upt= "UPDATE `info` SET `privacy`='$shipping' ";

// print_r($cat_upt);exit;
 $cat_upt_qry=mysqli_query($con,$cat_upt);
 if($cat_upt_qry==true){
    header('location:policy');
 }else{
    echo"not success ";
 }
}
