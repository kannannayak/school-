<?php
include("include/header.php");
include("include/conn.php");

ini_set('error_reporting', 0);
ini_set('display_errors', 0);  

$id = $_GET['id'];

$sql = "SELECT * FROM school_list where `school_id` = '$id'";
$result = mysqli_query($conn, $sql);											
if (mysqli_num_rows($result) > 0) {
$i=1;
    while($row = mysqli_fetch_assoc($result)) {
        $school_id = $row['school_id'];
        $school_name = $row['school_name'];
        $school_location = $row['school_location'];
        
    }
}

?>

<div id="page-wrapper">

<div class="page-content">

    <!-- begin PAGE TITLE ROW -->
    <div class="row">
        <div class="col-lg-12">
            <div class="page-title">
                <h1>Schools</h1>
                <ol class="breadcrumb">
                    <li><i class="fa fa-dashboard"></i>  <a href="index">Dashboard</a>
                    </li>
                    <li class="active">Add School</li>
                </ol>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <!-- end PAGE TITLE ROW -->

    <!-- begin MAIN PAGE ROW -->
    <div class="row">

        <div class="col-lg-12">
            <div class="portlet portlet-default">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h4><?php if($id == ''){ echo 'Add New School';} else{ echo 'Edit School';}?></h4>
                    </div>
                    <div class="portlet-widgets">
                        <a data-toggle="collapse" data-parent="#accordion" href="#inputSizing"><i class="fa fa-chevron-down"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="inputSizing" class="panel-collapse collapse in">
                    <div class="portlet-body">
                        <div class="row" id="campous">
                            <form method="post" action="action/schl" enctype="multipart/form-data">
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <label>School Name</label>
                                    <input required type="text" name="school_name" class="form-control" placeholder="School Name" value="<?php echo $school_name;?>"> 
                                    </div>
                                   <div class="col-lg-6">
                                        <label>School Location</label>
                                        <input required type="text" name="school_location" class="form-control" placeholder="Location" value="<?php echo $school_location;?>">
                                         <input type="hidden" name="school_id" value="<?php echo $school_id;?>">
                                   </div>
                                   
                                </div>
                                <br><br>
                                <!-- <div class="col-md-4 col-md-offset" style="margin-top: 14px;"></div> -->
                              
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
    <!-- /.row -->
    <!-- end MAIN PAGE ROW -->

</div>
<!-- /.page-content -->

</div>


<!-- end MAIN PAGE CONTENT -->

<?php
include("include/footer.php");
?>