<?php
include("include/header.php");
include("include/conn.php");

ini_set('error_reporting', 0);
ini_set('display_errors', 0);  

$id = $_GET['id'];

$sql = "SELECT * FROM isda_records WHERE `record_id` = '$id'";
$result = mysqli_query($conn, $sql);											
if (mysqli_num_rows($result) > 0) {
    $i=1;
    while($row = mysqli_fetch_assoc($result)) {
        $record_id  = $row['record_id'];
        $name = $row['name'];
        $gender_id = $row['gender_id'];
        $age = $row['age'];
        $game_type_id = $row['game_type_id'];
        $game_timing = $row['game_timing'];
    }
} else {
    $record_id = $name = $gender_id = $age = $game_type_id = $game_timing = '';
}
?>

<div id="page-wrapper">
<div class="page-content">
    <!-- begin PAGE TITLE ROW -->
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title">
                <h1>ISDA Records</h1>
                <ol class="breadcrumb">
                    <li><i class="fa fa-dashboard"></i>  <a href="index">Dashboard</a>
                    </li>
                    <li class="active"><?php echo $id == '' ? 'Add ISDA Record' : 'Edit ISDA Record'; ?></li>
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
                        <h4><?php echo $id == '' ? 'Add New Record' : 'Edit Record'; ?></h4>
                    </div>
                    <div class="portlet-widgets">
                        <a data-toggle="collapse" data-parent="#accordion" href="#inputSizing"><i class="fa fa-chevron-down"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="inputSizing" class="panel-collapse collapse in">
                    <div class="portlet-body">
                        <div class="row" id="campous">
                            <form method="post" action="action/isda" enctype="multipart/form-data">
                                <input type="hidden" name="record_id" value="<?php echo $record_id; ?>">
                                <div class="col-lg-12">
                                    <div class="col-lg-6" style="margin-bottom: 15px;">
                                        <label>Name</label>
                                        <input required type="text" name="name" class="form-control" placeholder=" Name" value="<?php echo $name;?>"> 
                                    </div>
                                    <div class="col-lg-6" style="margin-bottom: 15px;">
                                        <label>Gender</label>
                                        <select class="form-control" name="gender_id">
                                            <?php 
                                            if($id == ''){  
                                                echo '<option value="" >Select Gender</option>';
                                            }
                                            // Fetch the current gender details
                                            $sql_gender = "SELECT * FROM `gender` ORDER BY gender_id";
                                            $result_gender = mysqli_query($conn, $sql_gender);                                            
                                            if (mysqli_num_rows($result_gender) > 0) {
                                                while($row_gender = mysqli_fetch_assoc($result_gender)) {
                                                    $selected = $row_gender['gender_id'] == $gender_id ? 'selected' : '';
                                                    echo '<option value="'.$row_gender['gender_id'].'" '.$selected.'>'.$row_gender['gender_name'].'</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6" style="margin-bottom: 15px;">
                                        <label>Age</label>
                                        <input required type="text" name="age" class="form-control" placeholder="age" value="<?php echo $age;?>">
                                    </div>
                                    <div class="col-lg-6" style="margin-bottom: 15px;">
                                        <label>Game Type</label>
                                        <select class="form-control" name="game_type_id">
                                            <?php 
                                            if($id == ''){  
                                                echo '<option value="" >Select Game</option>';
                                            } else {
                                                $sql_game_type = "SELECT * FROM `game_type_web` WHERE `game_type_id` = '$game_type_id'";
                                                $result_game_type = mysqli_query($conn, $sql_game_type);
                                                if (mysqli_num_rows($result_game_type) > 0) {
                                                    $row_game_type = mysqli_fetch_assoc($result_game_type);
                                                    $game_type_name = $row_game_type['game_type_name'];
                                                    echo '<option value="'.$game_type_id.'" >'.$game_type_name.'</option>';
                                                }
                                            }
                                            // Fetch the remaining game types
                                            $sql = "SELECT * FROM `game_type_web` ORDER BY game_type_id";
                                            $result = mysqli_query($conn, $sql);                                            
                                            if (mysqli_num_rows($result) > 0) {
                                                while($row = mysqli_fetch_assoc($result)) {
                                                    if($row['game_type_id'] != $game_type_id) {
                                                        echo '<option value="'.$row['game_type_id'].'">'.$row['game_type_name'].'</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6" style="margin-bottom: 15px;">
                                        <label>Game Timing</label>
                                        <input required type="text" name="game_timing" class="form-control" placeholder="record" value="<?php echo $game_timing;?>">
                                    </div>
                                </div>
                                <br><br>
                                <div class="col-sm-12" style="margin-top: 14px;">
                                    <input type="submit" name="submit" id="brand_btn" class="btn btn-success" value="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.portlet -->
        </div>
    </div>
    <!-- end MAIN PAGE ROW -->
</div>
<!-- end MAIN PAGE CONTENT -->

<?php
include("include/footer.php");
?> 
