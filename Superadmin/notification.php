<?php
include("include/header.php");
include("include/conn.php");

$query1 = "SELECT noti.*, us.user_name, tri.trainer_name
           FROM `notification` AS `noti` 
           JOIN `users` AS `us` ON noti.user_id = us.user_id
           JOIN `trainer` AS `tri` ON noti.trainer_id = tri.trainer_id";

$result1 = mysqli_query($conn, $query1);

if (!$result1) {
    die('Query Error: ' . mysqli_error($conn));
}

// Process the result set here


if ($result1) {
    $drmsges = [];
    while ($row = mysqli_fetch_assoc($result1)) {
        $drmsges[] = $row;
    }
} else {
    echo "Error fetching driver notifications: " . mysqli_error($conn);
}
?>

<div id="page-wrapper" style="min-height:142vh;">
    <div class="page-content">
        <!-- begin PAGE TITLE ROW -->
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title">
                    <h1>Trainer Sent Notification</h1>
                </div>
                
                <div class="row">
                    <div>
                        <table id="data_table1" class="display dataTable table table-striped table-bordered table-hover table-green">
                            <thead>
                                <?php $id = 1; ?>
                                <tr>
                                    <th>S.No</th>
                                    <th>From (Trainer)</th>
                                    <th>To  (Students)</th>
                                    <th>Message</th>
                                    <th>Message Sent Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($drmsges as $drmsg) : ?>
                                    <tr>
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo htmlspecialchars($drmsg['trainer_name']); ?></td>
                                        <td><?php echo htmlspecialchars($drmsg['user_name']); ?></td>
                                        <td><?php echo htmlspecialchars($drmsg['message']); ?></td>
                                        <td><?php echo htmlspecialchars($drmsg['msg_sent_time']); ?></td>
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


<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> -->

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
           

         


    });
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

<!-- Scrollable modal -->
