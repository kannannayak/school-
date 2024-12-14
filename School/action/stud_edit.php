<?php
include("../include/conn.php");

$user_id = $_POST['id'];
$name = $_POST['name'];
$gender_id = $_POST['gender_id'];
$age = $_POST['age'];
$user_email = $_POST['user_email'];
$parent_name = $_POST['parent_name'];
$user_mobile = $_POST['user_mobile'];
$confirm_password = $_POST['confirm_password'];
$user_address = $_POST['user_address'];
$state_id = $_POST['state_id'];
$district_id = $_POST['district_id'];
$school_id = $_POST['school_id'];
$trainer_id = $_POST['trainer_id'];
$existing_id_proof = $_POST['existing_id_proof'];
$existing_profile_pic = $_POST['existing_profile_pic'];

$id_proof = $_FILES['id_proof']['name'];
$profile_pic = $_FILES['profile_pic']['name'];

if ($id_proof) {
    $id_proof_path = "../../../RestApi/userApi/upload/id_proof/" . basename($id_proof);
    move_uploaded_file($_FILES['id_proof']['tmp_name'], $id_proof_path);
} else {
    $id_proof_path = $existing_id_proof;
}

if ($profile_pic) {
    $profile_pic_path = "../../../RestApi/userApi/upload/profile_pic/" . basename($profile_pic);
    move_uploaded_file($_FILES['profile_pic']['tmp_name'], $profile_pic_path);
} else {
    $profile_pic_path = $existing_profile_pic;
}

$sql = "UPDATE users SET 
        user_name = ?, 
        gender = ?, 
        user_dob = ?, 
        user_email = ?, 
        parent_name = ?, 
        user_mobile = ?, 
        confirm_password = ?, 
        user_address = ?, 
        state = ?, 
        district = ?, 
        school_id = ?, 
        trainer_id = ?, 
        id_proof = ?, 
        profile_pic = ? 
        WHERE user_id = ?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'sissssssssssssi', $name, $gender_id, $age, $user_email, $parent_name, $user_mobile, $confirm_password, $user_address, $state_id, $district_id, $school_id, $trainer_id, $id_proof_path, $profile_pic_path, $user_id);

if (mysqli_stmt_execute($stmt)) {
    header("Location: ../student_list.php");
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
