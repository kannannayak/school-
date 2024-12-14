<?php include("include/header.php");
include('include/config.php'); ?>
<?php

$update_cat_query = "SELECT (`term`) FROM `info`";
$update_cat_stmt = mysqli_query($con, $update_cat_query);
$update_datat1 = mysqli_fetch_assoc($update_cat_stmt);
?>
<!-- /.navbar-side -->
<!-- end SIDE NAVIGATION -->

<!-- begin MAIN PAGE CONTENT -->
<div id="page-wrapper">

    <div class="page-content">

        <!-- begin PAGE TITLE AREA -->
        <!-- Use this section for each page's title and breadcrumb layout. In this example a date range picker is included within the breadcrumb. -->


        <!-- Blank Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row  bg-light rounded ">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1 class="mt-2 text-center">Terms and Condition
                                <small></small>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mx-auto">
                    <div class="portlet-heading">
                        <div class="portlet-title">
                            <h4>Terms and Condition</h4>
                        </div>
                        <div class="clearfix"></div>

                    </div>
                    <form action="add_tools.php" class="m-auto" method="post">

                        <!-- <input type="hidden" name="term_id" value="<?php echo $update_datat1['info_id'] ?>"> -->
                        <div class="portlet-body">
                            <!-- <h4>Tittle</h4>
                        <input type="text" class="form-control" placeholder="Add title" maxlength="50" id="basicMax" name="term_title" value="<?php echo $update_datat1['term_title']; ?>">   -->
                            <h4>Title</h4>
                            <textarea type="text" id="textareaMax" class="form-control" rows="14" placeholder="Enter your Description..." maxlength="1000" name="term_description" value="<?php echo $update_datat1['term']; ?>"><?php echo $update_datat1['term']; ?></textarea>
                            <br>




                            <div class="">
                                <button type="submit" name="save_terms" class="btn btn-success btn-block">Save</button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
        <!-- Blank End -->


    </div>
</div>
<!-- /#page-wrapper -->
<!-- end MAIN PAGE CONTENT -->
<script>
    // CKEDITOR.replace( 'term_title' );
    CKEDITOR.replace('term_description');
</script>
<?php include("include/footer.php"); ?>