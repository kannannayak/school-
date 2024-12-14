<?php
// Start output buffering
ob_start();

include("include/header.php");
include("include/conn.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);


?>

<div id="page-wrapper" style="min-height:142vh;">
    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
               

                <div class="page-title">
                    <h1>Trainers</h1>
                </div>
                <div class="row">
                    <div class="col-lg-12" style="margin-bottom:10px;"></div>
                </div>

                <table id="data_table2" class="display dataTable table table-striped table-bordered table-hover table-green">
                    <thead>
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Trainer Id</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Address</th>

                            <th scope="col">School</th>
                            <th scope="col">No of Students</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                          $school_id = $_SESSION['school_id'];
                          
                        $sql = "SELECT tri.*, sch.school_name, COUNT(us.user_id) AS num_students 
                        FROM trainer AS tri 
                        JOIN school_list AS sch ON tri.school_id = sch.school_id 
                        LEFT JOIN users AS us ON us.trainer_id = tri.trainer_id 
                        WHERE tri.trainer_status = '1' AND tri.school_id = $school_id
                        GROUP BY tri.trainer_id;";
                        $res = mysqli_query($conn, $sql);
                        if ($res) {
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($res)) {
                                $trainer_id = $row['trainer_id'];
                                $trainer_name = $row['trainer_name'];
                                $trainer_email = $row['trainer_email'];
                                $trainer_mobile = $row['trainer_mobile'];
                                $trainer_address = $row['trainer_address'];
                                $num_students = $row['num_students'];
                                $school_name = $row['school_name'];
                                $tlog_id = $row['tlog_id'];
                                $count++;
                        ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td><?= $trainer_name ?></td>
                                    <td><?= $tlog_id ?></td>
                                    <td><?= $trainer_email ?></td>
                                    <td><?= $trainer_mobile ?></td>
                                    <td><?= $trainer_address ?></td>
                                  
                                    <td><?= $school_name ?></td>
                                     <td><?= $num_students ?></td>
                                    <td style="display: flex; justify-content: space-evenly;">
                                        
                                          <a href="students_tri.php?id=<?= $trainer_id ?>">
                                            <button class="btn btn-primary"><i class="fa-solid fa-eye"></i></button>
                                        </a>
                                        <a href="action/delete_trainer.php?id=<?= $trainer_id ?>" class="text-default btn btn-danger "><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                        <?php
                            }
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
        $('#data_table1').DataTable({
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

        $('#data_table2').DataTable({
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
        
        $('#data_table3').DataTable({
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
    <?php if (isset($email_status)) : ?>
        swal("", "<?php echo $email_status; ?>", "<?php echo ($email_status == 'Email sent successfully') ? 'success' : 'error'; ?>");
    <?php endif; ?>
</script>

<?php
include("include/footer.php");

// Flush the output buffer
ob_end_flush();
?>
