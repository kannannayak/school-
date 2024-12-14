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
                    <h1>Students List</h1>
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
                            <th scope="col">Parent Name</th>
                            <th scope="col">Trainer</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Age</th>
                            <th scope="col">District</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if ($school_id !== null) {  // Ensure $school_id is set
                            $sql = "SELECT us.*, tri.trainer_name, sch.school_name,gen.gender_name,dis.district_name
                                    FROM users AS us
                                    JOIN trainer AS tri ON us.trainer_id = tri.trainer_id
                                    JOIN gender AS gen ON us.gender = gen.gender_id
                                    JOIN school_list AS sch ON us.school_id = sch.school_id
                                    JOIN district AS dis ON us.district = dis.district_id
                                    WHERE sch.school_id = $school_id";

                            $res = mysqli_query($conn, $sql);

                            if ($res) {
                                $count = 0;
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $count++;
                                    // Extract data
                                    $id = $row['user_id'];
                                    $user_uniq_id = $row['user_uniq_id'];
                                    $user_name = $row['user_name'];
                                    $parent_name = $row['parent_name'];
                                    $user_email = $row['user_email'];
                                    $user_mobile = $row['user_mobile'];
                                    $user_age = $row['user_age'];
                                    $gender_name = $row['gender_name'];
                                    $school_name = $row['school_name'];
                                    $district = $row['district_name'];
                                    $trainer_name = $row['trainer_name'];
                    ?>

                                    <tr>
                                        <td><?= $count ?></td>
                                        <td><?= htmlspecialchars($user_name) ?></td>
                                        <td><?= htmlspecialchars($user_uniq_id) ?></td>
                                        <td><?= htmlspecialchars($school_name) ?></td>
                                        <td><?= htmlspecialchars($parent_name) ?></td>
                                        <td><?= htmlspecialchars($trainer_name) ?></td>
                                        <td><?= htmlspecialchars($user_email) ?></td>
                                        <td><?= htmlspecialchars($user_mobile) ?></td>
                                        <td><?= htmlspecialchars($gender_name) ?></td>
                                        <td><?= htmlspecialchars($user_age) ?></td>
                                        <td><?= htmlspecialchars($district) ?></td>
                                        <td>
                                            <a href="students_view.php?id=<?= $id ?>">
                                                <button class="btn btn-primary"><i class="fa-solid fa-eye"></i></button>
                                            </a>
                                        </td>
                                    </tr>

                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='12'>Query failed: " . mysqli_error($conn) . "</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='12'>No school ID provided.</td></tr>";
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
                    text: '<i class="fa-solid fa-download"></i> Print',
                    title: 'Driver Report',
                    titleAttr: 'Print User reports',
                },
            ]
        });

       
    })

       
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
