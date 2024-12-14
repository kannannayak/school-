<?php
include("include/header.php");
include("include/conn.php");

$id = isset($_GET['id']) ? $_GET['id'] : null;

$trainer_name = '';

if ($id) {
    // Retrieve the trainer's name based on the provided trainer_id
    $trainer_query = "SELECT trainer_name FROM trainer WHERE trainer_id = ?";
    if ($stmt = $conn->prepare($trainer_query)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($trainer_name);
        $stmt->fetch();
        $stmt->close();
    }
}
?>

<div id="page-wrapper" style="min-height:142vh;">
    <div class="page-content">
        <!-- begin PAGE TITLE ROW -->
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title">
                    <h1> Trainer Name : <?= htmlspecialchars($trainer_name) ?></h1>
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
                            <th scope="col">Parent Name</th>
                            <th scope="col">Uniq id</th>
                            <th scope="col">Trainer Name</th>
                            <th scope="col">School</th>
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
                        $sql = "SELECT us.*, gen.gender_name, sch.school_name, tri.trainer_name 
                                FROM users AS us
                                JOIN school_list AS sch ON us.school_id = sch.school_id
                                JOIN gender AS gen ON us.gender = gen.gender_id
                                JOIN trainer AS tri ON us.trainer_id = tri.trainer_id
                                WHERE us.trainer_id = ?";

                        if ($stmt = $conn->prepare($sql)) {
                            $stmt->bind_param("i", $id);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                $count = 0;
                                while ($row = $result->fetch_assoc()) {
                                    $count++;
                                    $user_id = $row['user_id'];
                                    $user_uniq_id = $row['user_uniq_id'];
                                    $user_name = $row['user_name'];
                                    $parent_name = $row['parent_name'];
                                    $user_email = $row['user_email'];
                                    $user_mobile = $row['user_mobile'];
                                    $user_age = $row['user_age'];
                                    $gender_name = $row['gender_name'];
                                    $school_name = $row['school_name'];
                                    $district = $row['district'];
                                    $trainer_name = $row['trainer_name'];
                        ?>

                                    <tr>
                                        <td><?= $count ?></td>
                                        <td><?= htmlspecialchars($user_name) ?></td>
                                        <td><?= htmlspecialchars($parent_name) ?></td>
                                        <td><?= htmlspecialchars($user_uniq_id) ?></td>
                                        <td><?= htmlspecialchars($trainer_name) ?></td>
                                        <td><?= htmlspecialchars($school_name) ?></td>
                                        <td><?= htmlspecialchars($user_email) ?></td>
                                        <td><?= htmlspecialchars($user_mobile) ?></td>
                                        <td><?= htmlspecialchars($gender_name) ?></td>
                                        <td><?= htmlspecialchars($user_age) ?></td>
                                        <td><?= htmlspecialchars($district) ?></td>
                                        <td>
                                            <a href="students_view.php?id=<?= $user_id ?>">
                                                <button class="btn btn-primary"><i class="fa-solid fa-eye"></i></button>
                                            </a>
                                        </td>
                                    </tr>

                        <?php
                                }
                            }
                            $stmt->close();
                        }
                        ?>
                    </tbody>
                </table>

                <!-- Additional code for displaying all users, if necessary -->
                <!-- Removed for brevity -->

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
                    titleAttr: 'Download as CSV File',
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
                    title: 'User Report',
                    titleAttr: 'Download as PDF File',
                },
                {
                    extend: 'print',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> Print',
                    title: 'User Report',
                    titleAttr: 'Print User Reports',
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
    if (isset($_GET['msg']) && $_GET['msg'] != '') {
    ?>
        swal("", "<?php echo htmlspecialchars($_GET['msg']); ?>", "success");
        if (window.history.replaceState) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    <?php
    }
    ?>
</script>
