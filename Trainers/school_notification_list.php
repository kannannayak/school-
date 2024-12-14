<?php
include("include/header.php");
include("include/conn.php");
?>

<style>
    .profile {
        color: #102B6E !important;
        margin-top: 25px;
        margin-left: 50px;
    }
    body {
        background: #E6F4FB !important;
    }
    .heading {
        background: #0095DA !important;
        color: white;
        font-weight: bold;
    }
    .bodyColor {
        background: #E6F4FB !important;
    }
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        background-color: #102B6E;
    }
    .custom-input-class {
        width: 100%;
        height: 30px;
        padding: 5px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
    }
</style>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css">

<h4 class="profile">School Notification List</h4>

<div class="table-responsive card">
    <table id="myTable" class="table display table-striped custom-table users" width="100%">
        <thead>
            <tr class="heading">
                <th scope="col">SN</th>
                <th scope="col">Messages</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
            </tr>
        </thead>
        <tbody class="bodyColor">
           <?php
$tlog_id = $_SESSION['tlog_id'];
$sql = "SELECT * FROM school_notification JOIN school_list ON school_list.school_id = school_notification.school_id JOIN trainer ON trainer.school_id=school_notification.school_id WHERE trainer.tlog_id = '$tlog_id' ORDER BY school_notification.sch_not_id DESC LIMIT 0, 25;";
$res = mysqli_query($conn, $sql);
if ($res && mysqli_num_rows($res) > 0) {
    $count = 0;
    while ($row = mysqli_fetch_assoc($res)) {
        $id = $row['sch_not_id'];
        $message = $row['schl_msg'];
        
        // Convert UTC time to IST
        $utc_time = new DateTime($row['msg_sent'], new DateTimeZone('UTC'));
        $utc_time->setTimezone(new DateTimeZone('Asia/Kolkata'));
       $msg_sent_date_ist = $utc_time->format('d-m-Y'); // Format the date
        $msg_sent_time_ist = $utc_time->format('H:i'); 
        
        $count++;
?>
        <tr>
            <th><?php echo $count; ?></th>
            <td><?php echo htmlspecialchars($message); ?></td>
            <td><?php echo $msg_sent_date_ist; ?></td>
                      
              <td><?php echo $msg_sent_time_ist; ?></td>
              <!-- <td><?php echo $msg_sent_date_ist; ?></td>-->
        </tr>
<?php
    }
} else {
?>
    <tr>
        <td colspan="3" class="text-center">No notifications found.</td>
    </tr>
<?php
}
?>


         
        </tbody>
    </table>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> Excel',
                    title: 'Notification Reports',
                    titleAttr: 'Download as Excel File',
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> PDF',
                    title: 'Notification Reports',
                    titleAttr: 'Download as PDF File',
                }
            ],
            initComplete: function() {
                this.api().columns().every(function(index) {
                    if (index !== 4) {
                        let column = this;
                        let title = $(column.footer()).text();
                        let input = document.createElement('input');
                        input.placeholder = title;
                        input.className = 'custom-input-class';
                        $(column.header()).append(input);
                        $(input).on('keyup change clear', function() {
                            if (column.search() !== this.value) {
                                column.search(this.value).draw();
                            }
                        });
                    }
                });
            }
        });

        $('.dt-button').css({
            'background': '#0191D6',
            'color': '#fff',
            'border-radius': '5px',
            'font-size': '15px',
            'margin-top': '20px',
            'margin-left': '20px',
        });

        $('.dataTables_filter').css({
            'margin-top': '20px',
            'margin-right': '20px',
        });

        $('.users').on('click', '.delete-btn', function(e) {
            e.preventDefault();
            var button = $(this);
            var id = button.data('id');

            Swal.fire({
                title: 'Confirmation',
                text: 'Are you sure you want to delete this item?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'delete_notification.php',
                        method: 'POST',
                        data: { id: id },
                        success: function(response) {
                            if (response.trim() === 'success') {
                                button.closest('tr').remove();
                                Swal.fire({
                                    title: 'Success',
                                    text: 'Message deleted successfully!',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 800
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Failed to delete item!',
                                    icon: 'error',
                                    showConfirmButton: false,
                                    timer: 800
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: 'Error',
                                text: 'An error occurred: ' + error,
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                }
            });
        });
    });
</script>

<?php 
include("include/footer.php");
?>
