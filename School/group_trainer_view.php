<?php
include("include/header.php");
include("include/conn.php");

$school_id = isset($_GET['id']) ? (int)$_GET['id'] : null;  // Ensure $school_id is an integer

?>

<div id="page-wrapper" style="min-height:142vh;">
    <div class="page-content">
        <!-- begin PAGE TITLE ROW -->
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title">
                    <h1>Trainer List</h1>
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
                            <th scope="col">Name</th>
                            <th scope="col">Uniq id</th>
                            <th scope="col">School Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">No of Students</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($school_id) {
                            $sql = "SELECT tri.*, sch.school_name, COUNT(us.user_id) AS num_students
                                    FROM trainer AS tri 
                                    JOIN school_list AS sch ON tri.school_id = sch.school_id
                                    LEFT JOIN users AS us ON us.trainer_id = tri.trainer_id
                                    WHERE tri.trainer_status = '1' AND tri.school_id = $school_id
                                    GROUP BY tri.trainer_id, sch.school_name";

                            $res = mysqli_query($conn, $sql);

                            if ($res) {
                                $count = 0;
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $trainer_id = $row['trainer_id'];
                                    $trainer_name = $row['trainer_name'];
                                    $trainer_email = $row['trainer_email'];
                                    $trainer_mobile = $row['trainer_mobile'];
                                    $school_name = $row['school_name'];
                                    $tlog_id = $row['tlog_id'];
                                    $num_students = $row['num_students'];
                                    $count++;
                        ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td><?= $trainer_name ?></td>
                                    <td><?= $tlog_id ?></td>
                                    <td><?= $school_name ?></td>
                                    <td><?= $trainer_email ?></td>
                                    <td><?= $trainer_mobile ?></td>
                                    <td><?= $num_students ?></td>
                                    <td>
                                        <a href="students_tri.php?id=<?= $trainer_id ?>">
                                            <button class="btn btn-primary"><i class="fa-solid fa-eye"></i></button>
                                        </a>
                                    </td>
                                </tr>
                        <?php
                                }
                            } else {
                                echo "<tr><td colspan='8'>Query failed: " . mysqli_error($conn) . "</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8'>No school ID provided.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
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
                    text: '<i class="fa-solid fa-download'></i> Print',
                    title: 'Driver Report',
                    titleAttr: 'Print User reports',
                },
            ]
        });

    });
</script>

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

<?php
include("include/footer.php");
?>
