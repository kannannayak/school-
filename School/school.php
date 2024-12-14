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
                            <a href="add_camp.php" class="btn btn-success">Add New <strong>+</strong></a>
                        </div>
                    </div>

                </div>
                <table id="data_table" class=" display dataTable table table-striped table-bordered table-hover table-green">
                    <thead>
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">School Name</th>
                            <th scope="col">School Location</th>
                            <th scope="col" class="text-center">Created Date</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `school_list` ORDER BY school_id ";
                        $res = mysqli_query($conn, $sql);

                        if ($res) {
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($res)) {


                                $id = $row['school_id'];
                                $school_name = $row['school_name'];
                                $school_location = $row['school_location'];
                                $school_create_dt = $row['school_create_dt'];



                                $count = $count + 1;

                        ?>

                                <tr>
                                    <td><?= $count ?></td>
                                    <td><?= $school_name ?></td>
                                    <td><?= $school_location ?></td>
                                    <td><?= $school_create_dt ?></td>




                                   
                                    

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