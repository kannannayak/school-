<?php
include("include/header.php");
include("include/conn.php");

ini_set('error_reporting', 0);
ini_set('display_errors', 0);

$user_id = isset($_GET['id']) ? $_GET['id'] : null;

if (!empty($user_id)) {
    $sql = "SELECT us.*, sch.school_name, tri.trainer_name, st.state_id, st.state_name, dis.district_id, dis.district_name
            FROM `users` AS us
            JOIN school_list AS sch ON us.school_id = sch.school_id
            JOIN trainer AS tri ON us.trainer_id = tri.trainer_id
            JOIN state AS st ON us.state = st.state_id
            JOIN district AS dis ON us.district = dis.district_id
            WHERE us.user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['user_id'];
        $user_uniq_id = $row['user_uniq_id'];
        $user_name = $row['user_name'];
        $parent_name = $row['parent_name'];
        $user_email = $row['user_email'];
        $user_mobile = $row['user_mobile'];
        $user_dob = $row['user_dob'];
        $gender_name = $row['gender_name'];
        $school_name = $row['school_name'];
        $district = $row['district_id'];
        $trainer_name = $row['trainer_name'];
        $state = $row['state_id'];
        $user_address = $row['user_address'];
        $confirm_password = $row['confirm_password'];
        $id_proof = $row['id_proof'];
        $profile_pic = $row['profile_pic'];
    }
}
?>
<div id="page-wrapper">
    <div class="page-content">
        <!-- begin PAGE TITLE ROW -->
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title">
                    <h1>Students</h1>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-dashboard"></i>  <a href="index">Dashboard</a></li>
                        <li class="active"><?php echo 'Edit Students'; ?></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end PAGE TITLE ROW -->

        <!-- begin MAIN PAGE ROW -->
        <div class="row">
            <div class="col-lg-12">
                <div class="portlet portlet-default">
                    <div class="portlet-heading">
                        <div class="portlet-title">
                            <h4><?php echo 'Edit Students'; ?></h4>
                        </div>
                        <div class="portlet-widgets">
                            <a data-toggle="collapse" data-parent="#accordion" href="#inputSizing"><i class="fa fa-chevron-down"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="inputSizing" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <div class="row" id="campous">
                                <form method="post" action="action/stud_edit.php" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $user_id; ?>">
                                    <input type="hidden" name="existing_id_proof" value="<?php echo $id_proof; ?>">
                                    <input type="hidden" name="existing_profile_pic" value="<?php echo $profile_pic; ?>">
                                    <div class="col-lg-12">
                                        <div class="col-lg-4" style="margin-bottom: 15px;">
                                            <label>Name</label>
                                            <input required type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $user_name; ?>"> 
                                        </div>
                                        <div class="col-lg-4" style="margin-bottom: 15px;">
                                            <label>Gender</label>
                                            <select class="form-control" name="gender_id">
                                                <?php 
                                                if (empty($id)) {  
                                                    echo '<option value="" >Select Gender</option>';
                                                }
                                                $sql_gender = "SELECT * FROM `gender` ORDER BY gender_id";
                                                $result_gender = mysqli_query($conn, $sql_gender);                                            
                                                if (mysqli_num_rows($result_gender) > 0) {
                                                    while ($gender = mysqli_fetch_assoc($result_gender)) {
                                                        $selected = $gender['gender_id'] == $row['gender_id'] ? 'selected' : '';
                                                        echo '<option value="'.$gender['gender_id'].'" '.$selected.'>'.$gender['gender_name'].'</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-4" style="margin-bottom: 15px;">
                                            <label>Age</label>
                                            <input required type="date" name="age" class="form-control" value="<?php echo $user_dob; ?>">
                                        </div>
                                        <div class="col-lg-4" style="margin-bottom: 15px;">
                                            <label>Email Id</label>
                                            <input required type="text" name="user_email" class="form-control"  value="<?php echo $user_email; ?>">
                                        </div>
                                        <div class="col-lg-4" style="margin-bottom: 15px;">
                                            <label>Parent Name</label>
                                            <input required type="text" name="parent_name" class="form-control"  value="<?php echo $parent_name; ?>">
                                        </div>
                                        <div class="col-lg-4" style="margin-bottom: 15px;">
                                            <label>Phone Number</label>
                                            <input required type="text" name="user_mobile" class="form-control" value="<?php echo $user_mobile; ?>">
                                        </div>
                                        <div class="col-lg-4" style="margin-bottom: 15px;">
                                            <label>Password</label>
                                            <input required type="text" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                                        </div>
                                        <div class="col-lg-4" style="margin-bottom: 15px;">
                                            <label>Address</label>
                                            <input required type="text" name="user_address" class="form-control" value="<?php echo $user_address; ?>">
                                        </div>
                                        <div class="col-lg-4" style="margin-bottom: 15px;">
                                            <label>State</label>
                                            <select name="state_id" id="state_id" class="form-control">
                                                <?php
                                                $result_state = mysqli_query($conn, "SELECT * FROM state");
                                                while ($state_row = mysqli_fetch_array($result_state)) {
                                                    echo "<option value='" . $state_row['state_id'] . "'";
                                                    if ($state_row['state_id'] == $row['state']) {
                                                        echo " selected";
                                                    }
                                                    echo ">" . $state_row['state_name'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-4" style="margin-bottom: 15px;">
                                            <label>District</label>
                                            <select name="district_id" id="district_id" class="form-control">
                                                <?php
                                                $result_district = mysqli_query($conn, "SELECT * FROM district WHERE state_id = " . $row['state']);
                                                while ($district_row = mysqli_fetch_array($result_district)) {
                                                    echo "<option value='" . $district_row['district_id'] . "'";
                                                    if ($district_row['district_id'] == $row['district']) {
                                                        echo " selected";
                                                    }
                                                    echo ">" . $district_row['district_name'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-4" style="margin-bottom: 15px;">
                                            <label>School</label>
                                            <select name="school_id" id="school_id" class="form-control">
                                                <?php
                                                $result_school = mysqli_query($conn, "SELECT * FROM school_list ORDER BY school_id");
                                                while ($school_row = mysqli_fetch_array($result_school)) {
                                                    echo "<option value='" . $school_row['school_id'] . "'";
                                                    if ($school_row['school_id'] == $row['school_id']) {
                                                        echo " selected";
                                                    }
                                                    echo ">" . $school_row['school_name'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-4" style="margin-bottom: 15px;">
                                            <label>Trainer</label>
                                            <select name="trainer_id" id="trainer_id" class="form-control">
                                                <?php
                                                $result_trainer = mysqli_query($conn, "SELECT * FROM trainer WHERE school_id = " . $row['school_id'] . " ORDER BY trainer_id");
                                                while ($trainer_row = mysqli_fetch_array($result_trainer)) {
                                                    echo "<option value='" . $trainer_row['trainer_id'] . "'";
                                                    if ($trainer_row['trainer_id'] == $row['trainer_id']) {
                                                        echo " selected";
                                                    }
                                                    echo ">" . $trainer_row['trainer_name'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-4" style="margin-bottom: 15px;">
                                            <label>ID Proof</label>
                                            <input type="file" name="id_proof" class="form-control">
                                            <?php if ($id_proof) : ?>
                                                <a href="<?php echo $id_proof; ?>" target="_blank">View ID Proof</a>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-lg-4" style="margin-bottom: 15px;">
                                            <label>Profile Picture</label>
                                            <input type="file" name="profile_pic" class="form-control">
                                            <?php if ($profile_pic) : ?>
                                                <a href="<?php echo $profile_pic; ?>" target="_blank">View Profile Picture</a>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-lg-12" style="margin-bottom: 15px;">
                                            <button type="submit" class="btn btn-success">Update Student</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.portlet-body -->
                    </div>
                    <!-- /.panel-collapse -->
                </div>
                <!-- /.portlet -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.page-content -->
</div>
<!-- /#page-wrapper -->

<?php include("include/footer.php"); ?>

<script>
$(document).ready(function() {
    $("#state_id").change(function(){
        var state_id = $(this).val();
        $.ajax({
            url: "get_district.php",
            method: "POST",
            data: {state_id: state_id},
            success: function(data) {
                $("#district_id").html(data);
            }
        });
    });

    $("#school_id").change(function(){
        var school_id = $(this).val();
        $.ajax({
            url: "get_trainer.php",
            method: "POST",
            data: {school_id: school_id},
            success: function(data) {
                $("#trainer_id").html(data);
            }
        });
    });
});
</script>

