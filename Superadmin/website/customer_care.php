<?php include("include/header.php"); ?>
<?php include('include/config.php'); ?>

<?php
$update_cat_query = "SELECT (`customer_care`) FROM `info`";
$update_cat_stmt = mysqli_query($con, $update_cat_query);
$update_datat1 = mysqli_fetch_assoc($update_cat_stmt);
?>
<div class="container-fluid pt-4 px-4 ">
    <div class="row vh-100 bg-light rounded ">
        <div class="col-md-12 ">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-title text-center">
                        <h1 class="mt-2">Customer care Details</h1>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 offset-lg-3">
                <div class="portlet portlet-green">
                    <div class="portlet-heading">
                        <div class="portlet-title">
                            <!--<h4>About Us</h4>-->
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <form action="add_tools.php" method="post">
                        <div class="portlet-body">
                            <h4 class="text-center">Description</h4>
                            <textarea id="textareaMax" class="form-control" rows="14" placeholder="Enter your Description..." maxlength="1000" name="customer_care"><?php echo htmlspecialchars($update_datat1['customer_care']); ?></textarea>
                            <br>
                            <div class="text-center">
                                <button type="submit" name="care_submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    // Initialize CKEditor for the textarea
    CKEDITOR.replace('customer_care');
</script>

<?php include("include/footer.php"); ?>
