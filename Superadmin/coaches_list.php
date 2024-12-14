<?php
// Start output buffering
ob_start();

include("include/header.php");
include("include/conn.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['send_email'])) {
        $id = $_POST['id'];
        $email = $_POST['email'];
        $tlog_id = $_POST['tlog_id'];
        $password = $_POST['password'];

        // Update trainer status to 1 (Accepted) in the database
        $update_sql = "UPDATE trainer SET trainer_status = 1 WHERE trainer_id = $id";
        if (mysqli_query($conn, $update_sql)) {
            // Send password to the trainer's email
            require_once "Mail/phpmailer/PHPMailerAutoload.php";
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Username = 'vicky964242@gmail.com';
            $mail->Password = 'imfxosyiuhtynzff';
            $mail->setFrom('vicky964242@gmail.com', 'Request Approved');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = "Your password";
            $mail->Body = "<p> Hello Trainer , <br> </p> <h4> Your registration has been approved  </h4><h3>Your Trainer Id is $tlog_id <br></h3>
                </h4><h3>Your Password Id is $password <br></h3>
                <br><br><p>With regards,</p><b>The Mithra Sports</b>";

            if ($mail->send()) {
                echo '<script>alert("Password sent successfully!");</script>';
            } else {
                echo '<script>alert("Error sending password!");</script>';
            }

            // Redirect back to the same page after updating status and sending password
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo '<script>alert("Error updating status!");</script>';
        }
    } elseif (isset($_POST['decline'])) {
        $id = $_POST['id'];
        $email = $_POST['email']; // Add email variable here

        // Update trainer status to 2 (Declined) in the database
        $update_sql = "UPDATE trainer SET trainer_status = 2 WHERE trainer_id = $id";
        if (mysqli_query($conn, $update_sql)) {
            // Send rejection email to the trainer
            require_once "Mail/phpmailer/PHPMailerAutoload.php";
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Username = 'vicky964242@gmail.com';
            $mail->Password = 'imfxosyiuhtynzff';
            $mail->setFrom('vicky964242@gmail.com', 'Request Declined');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = "Your Registration";
            $mail->Body = "<p> Hello Trainer , <br> </p>
                <h4> Your Approval has been Rejected  </h4><br><br>
                <p>With regards,</p>
                <b>The Mithra Sports</b>";

            if ($mail->send()) {
                echo '<script>alert("Rejection email sent successfully!");</script>';
            } else {
                echo '<script>alert("Error sending rejection email!");</script>';
            }

            // Redirect back to the same page after updating status
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo '<script>alert("Error updating status!");</script>';
        }
    }
}
?>

<div id="page-wrapper" style="min-height:142vh;">
    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title">
                    <h1>Request List</h1>
                </div>
                <div class="row">
                    <div class="col-lg-12" style="margin-bottom:10px;"></div>
                </div>

                <table id="data_table1" class="display dataTable table table-striped table-bordered table-hover table-green">
                    <thead>
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Trainer Id</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Address</th>
                            <th scope="col">School</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT tri.*, sch.school_name 
                        FROM trainer AS tri JOIN school_list AS sch ON tri.school_id = sch.school_id
                        WHERE trainer_status = '0'";
                        $res = mysqli_query($conn, $sql);
                        if ($res) {
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($res)) {
                                $trainer_id = $row['trainer_id'];
                                $trainer_name = $row['trainer_name'];
                                $trainer_email = $row['trainer_email'];
                                $trainer_mobile = $row['trainer_mobile'];
                                $trainer_address = $row['trainer_address'];
                                $trainer_school = $row['school_name'];
                                $tlog_id = $row['tlog_id'];
                                $tlog_pass = $row['tlog_pass'];
                                $count++;
                        ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td><?= $trainer_name ?></td>
                                    <td><?= $tlog_id ?></td>
                                    <td><?= $trainer_email ?></td>
                                    <td><?= $trainer_mobile ?></td>
                                    <td><?= $trainer_address ?></td>
                                    <td><?= $trainer_school ?></td>
                                    <td>pending</td>
                                    <td style="display: flex; justify-content: space-evenly;">
                                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="my_form">
                                            <input type="hidden" name="id" value="<?= $trainer_id ?>">
                                            <input type="hidden" name="email" value="<?= $trainer_email ?>">
                                            <input type="hidden" name="tlog_id" value="<?= $tlog_id ?>">
                                            <input type="hidden" name="password" value="<?= $tlog_pass ?>">
                                            <button type="submit" name="send_email" class="btn btn-success">Accept</button>
                                            <button type="submit" name="decline" class="btn btn-danger">Decline</button>
                                        </form>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>

                <div class="page-title">
                    <h1>Approved Trainers</h1>
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
                        $sql = "SELECT tri.*, sch.school_name, COUNT(us.user_id) AS num_students 
                        FROM trainer AS tri 
                        JOIN school_list AS sch ON tri.school_id = sch.school_id 
                        LEFT JOIN users AS us ON us.trainer_id = tri.trainer_id 
                        WHERE tri.trainer_status = '1' 
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
                
                
                 <div class="page-title">
                    <h1>Rejected Trainers</h1>
                </div>
                <div class="row">
                    <div class="col-lg-12" style="margin-bottom:10px;"></div>
                </div>

                <table id="data_table3" class="display dataTable table table-striped table-bordered table-hover table-green">
                    <thead>
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Trainer Id</th>
                            <th scope="col">Email</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Address</th>
                          
                            <th scope="col">School</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT tri.*, sch.school_name FROM trainer AS tri JOIN school_list AS sch ON tri.school_id = sch.school_id WHERE tri.trainer_status = '2'";
                        $res = mysqli_query($conn, $sql);
                        if ($res) {
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($res)) {
                                $trainer_id = $row['trainer_id'];
                                $trainer_name = $row['trainer_name'];
                                $trainer_email = $row['trainer_email'];
                                $trainer_mobile = $row['trainer_mobile'];
                                $trainer_address = $row['trainer_address'];
                               
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
                                    <td style="display: flex; justify-content: space-evenly;">
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
