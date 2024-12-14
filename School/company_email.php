<?php
include("include/header.php");
include("include/conn.php");

error_reporting(1);

$update_cat_query = "SELECT `email` FROM `info`";
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
                    <h1>Company's Email ID</h1>
                </div>
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="portlet portlet-default">
                        <div class="portlet-heading">
                            <div class="portlet-title">
                                <h4>Set Company's Email ID</h4>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <form action="company_email.php" method="post">
                            <div class="portlet-body">

                                <h4>Content</h4>
                                <textarea type="text" id="editor1" class="form-control" rows="14" placeholder="Enter your Description..." maxlength="1000" name="email" value="<?php echo $update_datat1['email']; ?>"><?php echo $update_datat1['email']; ?></textarea>

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

<?php

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);


    if (empty($email)) {
        // die("Please fill out all required fields.");
        // 
?>
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

    $sql = "UPDATE `info` SET `email`='$email'";
    if (mysqli_query($conn, $sql)) {
        // echo "Record inserted successfully.";
        // 
    ?>
        <script>
            Swal.fire({
                title: 'Successfully!',
                text: '',
                icon: 'success',
            }).then((result) => {
                if (result.isConfirmed) {

                    window.location.href = 'company_email.php';
                }
            });
        </script>
<?php
    }
}
?>

<script>
    CKEDITOR.replace('editor1');
</script>->

<?php
include("include/footer.php");
?>