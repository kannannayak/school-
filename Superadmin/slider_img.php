<?php
include("include/header.php");
include("include/conn.php");
?>

<!-- begin MAIN PAGE CONTENT -->
<div id="page-wrapper" style="min-height:142vh;">
    <div class="page-content">
        <!-- begin PAGE TITLE ROW -->
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title">
                    <h1>School</h1>
                </div>
                <div class="row">
                    <div class="col-lg-6" style="margin-bottom:10px;">
                        <div class="pull-left">
                            <a href="add_images.php" class="btn btn-success">Add New <strong>+</strong></a>
                        </div>
                    </div>
                </div>
                <table id="data_table" class="display dataTable table table-striped table-bordered table-hover table-green">
                    <thead>
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Image</th>
                            <th scope="col" >Created Date</th>
                             <th scope="col" >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `images`";
                        $res = mysqli_query($conn, $sql);

                        if ($res) {
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($res)) {
                                $id = $row['image_id'];
                                $images_name = $row['images_name'];
                                $created_date = $row['created_date'];
                                $count++;
                        ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td>
                                        <img src="<?= $images_name ?>" width="100" height="100">
                                    </td>
                                    <td><?= $created_date ?></td>
                                    <td>
                                        <a href="action/slider_delete.php?id=<?= $id ?>">
                                            <button class="btn btn-danger">  <i class="fa fa-trash-o"></i> </button>
                                        </a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- /.col-lg-12 -->
            <div class="row"></div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#data_table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'csv',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> CSV ',
                    title:'Campus Report',
                    titleAttr: 'Download as CSV File',
                },
                {
                    extend: 'excel',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> Excel',
                    title:'Campus Report',
                    titleAttr:'Download as Excel File',
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> PDF',
                    title:'Campus Report',
                    titleAttr:'Download as PDF File',
                },
                {
                    extend: 'print',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> Print',
                    title:'Campus Report',
                    titleAttr:'Print User reports',
                },
            ]
        });
    });
</script>

<?php
include("include/footer.php");
?>

<script>
    <?php
    $msg = isset($_GET['msg']) ? $_GET['msg'] : '';
    if ($msg != '') {
    ?>
        swal("", "<?php echo $msg; ?>", "success");
        if (window.history.replaceState) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    <?php
    }
    ?>
</script>
