<?php
include("include/header.php");
include("include/conn.php");

ini_set('error_reporting', 0);
ini_set('display_errors', 0);
?>

<div id="page-wrapper">
    <div class="page-content">
        <!-- begin PAGE TITLE ROW -->
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title">
                    <h1>Sliders</h1>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-dashboard"></i> <a href="index">Dashboard</a></li>
                        <li class="active">Add Sliders</li>
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
                            <h4><?php echo empty($id) ? 'Add New Slider' : 'Edit Slider'; ?></h4>
                        </div>
                        <div class="portlet-widgets">
                            <a data-toggle="collapse" data-parent="#accordion" href="#inputSizing"><i class="fa fa-chevron-down"></i></a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div id="inputSizing" class="panel-collapse collapse in">
                        <div class="portlet-body">
                            <div class="row" id="campous">
                                <form method="post" action="action/sliders.php" enctype="multipart/form-data">
                                    <div class="col-lg-12">
                                        <div class="col-lg-6">
                                            <label>Add Sliders</label>
                                            <input required type="file" name="slider_name" class="form-control">
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
    <!-- /.page-content -->
</div>
<!-- end MAIN PAGE CONTENT -->

<?php
include("include/footer.php");
?>
