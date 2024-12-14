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
                    <h1>Age List</h1>
                </div>
                <div class="row">
                    <div class="col-lg-6" style="margin-bottom:10px;">
                        <div class="pull-left">
                            <a href="add_age.php" class="btn btn-success">Add New <strong>+</strong></a>
                        </div>
                    </div>

                </div>
                <table id="data_table" class=" display dataTable table table-striped table-bordered table-hover table-green">
                    <thead>
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Age Range</th>
                           
                           
                            <th scope="col" class="text-center">Action </th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `age`" ;
                      
                        $res = mysqli_query($conn, $sql);

                        if ($res) {
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($res)) {

                              $age_id  = $row['age_id'];
                                $min_age  = $row['min_age'];
                                $max_age = $row['max_age'];
                             
                              
                              



                                $count = $count + 1;

                        ?>
                            <tr>
                                <td><?= $count ?></td>
                                <td><?= $min_age ?> - <?= $max_age ?></td>
                                <!--<td></td>-->
                                <td style="display: flex; justify-content: space-evenly;">
                                    <a href="add_age.php?id=<?= $age_id ?>" class="text-default btn btn-warning">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="action/delete_age.php?id=<?= $age_id ?>" class="text-default btn btn-danger">
                                        <i class="fa fa-trash-o"></i>
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
            <div class="row">

            </div>
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
                    titleAttr: 'DownLoad as CSV File',
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

        
       
    })

</script>
</script>

<?php
include("include/footer.php");
?>

<script>
    <?php
    $msg = $_GET['msg'];
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