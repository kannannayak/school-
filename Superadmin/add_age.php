<?php
include("include/header.php");
include("include/conn.php");

ini_set('error_reporting', 0);
ini_set('display_errors', 0);  

$id = $_GET['id'];

$sql = "SELECT * FROM `age` WHERE `age_id` = '$id'";
$result = mysqli_query($conn, $sql);											
if (mysqli_num_rows($result) > 0) {
    $i=1;
    while($row = mysqli_fetch_assoc($result)) {
        $age_id  = $row['age_id'];
        $min_age = $row['min_age'];
     
        $max_age = $row['max_age'];
    }
} else {
    $age_id = $min_age  = $max_age = '';
}
?>

<div id="page-wrapper">
<div class="page-content">
    <!-- begin PAGE TITLE ROW -->
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title">
                <h1>Add age</h1>
                <ol class="breadcrumb">
                    <li><i class="fa fa-dashboard"></i>  <a href="index">Dashboard</a>
                    </li>
                    <li class="active"><?php echo $age_id == '' ? 'Add new age' : 'Edit age'; ?></li>
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
                        <h4><?php echo $age_id == '' ? 'Add New age' : 'Edit age'; ?></h4>
                    </div>
                    <div class="portlet-widgets">
                        <a data-toggle="collapse" data-parent="#accordion" href="#inputSizing"><i class="fa fa-chevron-down"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="inputSizing" class="panel-collapse collapse in">
                    <div class="portlet-body">
                        <div class="row" id="campous">
                            <form method="post" action="action/age" enctype="multipart/form-data">
                                <input type="hidden" name="age_id" value="<?php echo $age_id; ?>">
                                <div class="col-lg-12">
                                    <div class="col-lg-6" style="margin-bottom: 15px;">
                                        <label>Min age</label>
                                        <input required type="text" name="min_age" class="form-control" placeholder="Minimum Age" value="<?php echo $min_age;?>"> 
                                    </div>
                                    
                                </div>
                                  <div class="col-lg-12">
                                    <div class="col-lg-6" style="margin-bottom: 15px;">
                                        <label>max age</label>
                                        <input required type="text" name="max_age" class="form-control" placeholder="Maximum Age" value="<?php echo $max_age;?>"> 
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
