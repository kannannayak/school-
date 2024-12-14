<?php
include("include/header.php");
include("include/conn.php");

error_reporting(0);

// Fetch the current terms and conditions from the database
$update_cat_query = "SELECT `terms` FROM `info`";
$update_cat_stmt = mysqli_query($conn, $update_cat_query);
$update_datat1 = mysqli_fetch_assoc($update_cat_stmt);
?>
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"> -->

<!-- begin MAIN PAGE CONTENT -->
<div id="page-wrapper">
    <div class="page-content" style="min-height:142vh;">
        <!-- begin PAGE TITLE ROW -->
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title">
                    <h1>Terms & Condition</h1>
                </div>
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="portlet portlet-default">
                        <div class="portlet-heading">
                            <div class="portlet-title">
                                <h4>Set Terms & Condition</h4>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <form action="" method="post">
                            <div class="portlet-body">
                                <h4>Content</h4>
                                <textarea id="editor1" class="form-control" rows="14" placeholder="Enter your Description..." maxlength="1000" name="terms"><?php echo htmlspecialchars($update_datat1['terms']); ?></textarea>
                                <br>
                                <div class="">
                                    <input type="submit" value="Save" name="submit" class="btn btn-green btn-block">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
</div>

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> -->
<!-- <script>
$(document).ready(function() {
    $('#data_table').DataTable();
});
</script> -->

<?php

if (isset($_POST['submit'])) {
    $terms = mysqli_real_escape_string($conn, $_POST['terms']);

    if (empty($terms)) {
        // ?>
        <script>
            Swal.fire(
                'Fields Empty',
                'Please fill out all required fields',
                'warning'
            )
        </script>
        <?php
        exit;
    }

    $sql = "UPDATE `info` SET `terms`='$terms'";
    if (mysqli_query($conn, $sql)) {
        // ?>
        <script>
            Swal.fire({
                title: 'Successfully!',
                text: '',
                icon: 'success',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'Terms_condition.php';
                }
            });
        </script>
        <?php
    } else {
        // ?>
        <script>
            Swal.fire(
                'Error!',
                'There was a problem updating the record.',
                'error'
            )
        </script>
        <?php
    }
}
?>

<script>
    CKEDITOR.replace('editor1');
</script>

<?php
include("include/footer.php");
?>
