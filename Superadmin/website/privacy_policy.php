<?php include("include/header.php");
include('include/config.php'); ?>
<?php

$update_cat_query = "SELECT (`rules`) FROM `info`";
$update_cat_stmt = mysqli_query($con, $update_cat_query);
$update_datat1 = mysqli_fetch_assoc($update_cat_stmt);
?>

<!-- Blank Start -->
<div class="container-fluid pt-4 px-4 ">
    <div class="row vh-100 bg-light rounded ">
        <div class="col-md-12 text-center">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title">
                        <h1>Rules
                            <small></small>
                        </h1>
                    </div>
                </div>
            </div>


            <div class="col-lg-6 col-lg-offset-3 m-auto">

                <div class="portlet portlet-green">
                    <div class="portlet-heading">
                        <div class="portlet-title">
                            <!--<h4>Rules</h4>-->
                        </div>
                        <div class="clearfix"></div>

                    </div>
                    <form action="add_tools.php" method="post">

                        <!-- <input type="hidden" name="policy_id" value="<?php echo $update_datat1['policy_id'] ?>"> -->
                        <div class="portlet-body">
                            <!--<h4>Tittle</h4>-->
                            <!-- <input type="text" class="form-control" placeholder="Add title" maxlength="50" id="basicMax" name="policy_title" value="<?php echo $update_datat1['policy_title']; ?>">   -->
                            <h4>Description</h4>
                            <textarea type="text" id="textareaMax" class="form-control" rows="14" placeholder="Enter your Description..." maxlength="1000" name="privacy" value="<?php echo $update_datat1['rules']; ?>"><?php echo $update_datat1['rules']; ?></textarea>
                            <br>
                            <div class="">
                                <button type="submit" name="policy_submit" class="btn btn-success btn-block">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Blank End -->

<script>
    // CKEDITOR.replace( 'term_title' );
    CKEDITOR.replace('privacy');
</script>

<?php include("include/footer.php"); ?>