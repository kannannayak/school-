<?php
include("include/header.php");
include("include/conn.php");
// error_reporting(E_ALL);
// ini_set('display_errors', 1);


// $id = 1;

$query1 = "SELECT * FROM `notification`";
$result1 = mysqli_query($conn, $query1);


if ($result1) {

    $drmsges = [];
    while ($row = mysqli_fetch_assoc($result1)) {
        $drmsges[] = $row;
    }
} else {
    echo "Error fetching driver notifications: " . mysqli_error($conn);
}


$query2 = "SELECT * FROM trainer_notification";
$result2 = mysqli_query($conn, $query2);


if ($result2) {

    $coordmsges = [];
    while ($row = mysqli_fetch_assoc($result2)) {
        $coordmsges[] = $row;
    }
} else {
    echo "Error fetching coordinator notifications: " . mysqli_error($conn);
}

?>


<body>
<div id="page-wrapper" style="min-height:142vh;">
    <div class="page-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title">
                    <h1>Notification</h1>
                </div>
              
                <div class="row">
                    <div>
                        <h1>Student Notification</h1>
                        <table id="data_table1" class="display dataTable table table-striped table-bordered table-hover table-green">
                            <thead>
                                <?php $id = 1; ?>
                                <tr>
                                    <th>S.No</th>
                                    <th>Student Message</th>
                                    <th>Student Name</th>
                                    <th>Message Sent Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($drmsges as $drmsg) : ?>
                                    <tr>
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo $drmsg['message']; ?></td>
                                        <td>
                                            <?php
                                            $query = "SELECT us.user_name FROM `notification` AS noti INNER JOIN users AS us ON noti.user_id = us.user_id WHERE noti.user_id = ?";
                                            $stmt = $conn->prepare($query);
                                            $stmt->bind_param('i', $drmsg['user_id']);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            $student = $result->fetch_assoc();
                                            echo $student ? $student['user_name'] : "Student name not found";
                                            $stmt->close();
                                            ?>
                                        </td>
                                        <td><?php echo $drmsg['msg_sent_time']; ?></td>
                                        <td style="display: flex;justify-content:space-evenly;">
                                            <a href="action/delete_notification.php?notifi_id=<?= $drmsg['notifi_id'] ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                    <?php $id++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <h1>Trainer Notification</h1>
                        <table id="data_table2" class="display dataTable table table-striped table-bordered table-hover table-green">
                            <?php $id = 1; ?>
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Trainer Message</th>
                                    <th>Trainer Name</th>
                                    <th>Message Sent Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($coordmsges as $coordmsg) : ?>
                                    <tr>
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo $coordmsg['msg_for_trainer']; ?></td>
                                        <td>
                                            <?php
                                            $query = "SELECT tri.trainer_name FROM `trainer_notification` AS trinoti INNER JOIN trainer AS tri ON trinoti.trainer_id = tri.trainer_id WHERE trinoti.trainer_id = ?";
                                            $stmt = $conn->prepare($query);
                                            if ($stmt) {
                                                $stmt->bind_param('i', $coordmsg['trainer_id']);
                                                $stmt->execute();
                                                $result = $stmt->get_result();
                                                $trainer = $result->fetch_assoc();
                                                echo $trainer ? $trainer['trainer_name'] : "Trainer name not found";
                                                $stmt->close();
                                            } else {
                                                echo "Error: " . $conn->error;
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $coordmsg['msg_sent_time']; ?></td>
                                        <td style="display: flex;justify-content:space-evenly;">
                                            <a href="action/delete_notification.php?tri_notifi_id=<?= $coordmsg['tri_notifi_id'] ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                    <?php $id++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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
                    title: 'Notification List Report',
                    titleAttr: 'DownLoad as CSV File',
                },
                {
                    extend: 'excel',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> Excel',
                    title: 'Notification List Report',
                    titleAttr: 'Download as Excel File',
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> PDF',
                    title: 'Notification List Report',
                    titleAttr: 'Download as PDF File',
                },
                {
                    extend: 'print',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> Print',
                    title: 'Notification List Report',
                    titleAttr: 'Print User reports',
                },

            ]
       
            })
            
            
         $('#data_table2').DataTable({
            dom: 'Bfrtip',

            buttons: [{
                    extend: 'csv',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> CSV ',
                    title: 'Notification List Report',
                    titleAttr: 'DownLoad as CSV File',
                },
                {
                    extend: 'excel',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> Excel',
                    title: 'Notification List Report',
                    titleAttr: 'Download as Excel File',
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> PDF',
                    title: 'Notification List Report',
                    titleAttr: 'Download as PDF File',
                },
                {
                    extend: 'print',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> Print',
                    title: 'Notification List Report',
                    titleAttr: 'Print User reports',
                },

            ]
       
            })
           

         


    });
</script>

<?php
include("include/footer.php");
?>