<?php
include("include/header.php");
include("include/conn.php");

?>

<div id="page-wrapper" style="min-height:142vh;">
    <div class="page-content">
        <!-- begin PAGE TITLE ROW -->
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title">
                    <h1>Groups List</h1>
                </div>
                <div class="row">
                    <div class="col-lg-12" style="margin-bottom:10px;">
                        <div class="pull-right">
                            <!-- <a href="download_profiles.php" class="btn btn-primary" >Download</a> -->
                        </div>
                    </div>
                </div>

                <table id="data_table" class="display dataTable table table-striped table-bordered table-hover table-green">
                    <thead>
                        <tr>
                            <th scope="col">S.No</th>

                            <th scope="col">School Name</th>
                            <th scope="col">Location</th>
                            <th scope="col">No Of Trainers</th>
                            <th scope="col">No Of Students</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                         $school_id = $_SESSION['school_id'];

                        $sql = "SELECT sch.school_id, sch.school_name, sch.school_location,
                                    (SELECT COUNT(DISTINCT trainer_id) FROM trainer WHERE trainer_status = '1' AND school_id = sch.school_id) AS num_trainers,
                                    (SELECT COUNT(user_id) FROM users WHERE school_id = sch.school_id) AS num_students
                                FROM school_list AS sch
                                WHERE sch.school_id = $school_id";

                        $res = mysqli_query($conn, $sql);

                        if ($res) {
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($res)) {
                                $count++;

                                // Generate group name like grp01
                                $group_name = "grp" . str_pad($count, 2, '0', STR_PAD_LEFT);
                                $num_trainers = $row['num_trainers'];
                                $school_name = $row['school_name'];
                                $school_location = $row['school_location'];
                                $num_students = $row['num_students'];
                                $school_id = $row['school_id'];

                        ?>

                                <tr>
                                    <td><?= $count ?></td>
                                    <!--<td><?= $group_name ?></td>-->
                                    <td><?= $school_name ?></td>
                                    <td><?= $school_location ?></td>
                                    <td><?= $num_trainers ?></td>
                                    <td><?= $num_students ?></td>
                                    <td>
                                        <a href="group_trainer_view.php?id=<?= $school_id ?>" class="text-default">
                                            <button class="btn btn-primary"><i class="fa-solid fa-eye"></i> </button>
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
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#data_table').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'csv',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> CSV ',
                    title: 'User Report',
                    titleAttr: 'DownLoad as CSV File',
                },
                {
                    extend: 'excel',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> Excel',
                    title: 'User Report',
                    titleAttr: 'Download as Excel File',
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> PDF',
                    title: 'Driver Report',
                    titleAttr: 'Download as PDF File',
                },
                {
                    extend: 'print',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> Print',
                    title: 'Driver Report',
                    titleAttr: 'Print User reports',
                },
            ]
        });

    });
</script>

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

<?php
include("include/footer.php");
?>
