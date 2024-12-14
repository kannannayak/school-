<?php
include('include/header.php');
include('include/config.php');
error_reporting(0);


$today_pay =  $_GET['id'];

$date = date('d');
$month = date('m');
$year = date('Y');

$TodayDate = $year . '-' . $month . '-' . $date;


$TotalUser = "SELECT COUNT(*) AS total_products FROM `reject_payments`";
$TotalUsers_result = mysqli_query($con, $TotalUser);
$rowTotalUsers = mysqli_fetch_assoc($TotalUsers_result);
$totalUsers = $rowTotalUsers['total_products'];


// Initialize $dateFilter variable
$dateFilter = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $minDate = $_POST['min'];
    $maxDate = $_POST['max'];



    // Create the date filter for the SQL query
    if ($minDate && $maxDate) {
        $minDate = date("Y-m-d", strtotime($minDate));
        $maxDate = date("Y-m-d", strtotime($maxDate. ' +1 day'));
        $dateFilter = "AND a.created_dt BETWEEN '$minDate' AND '$maxDate'";
    }
}
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded justify-content-center mx-0">
        <div class="col-md-12">
            <div class="row my-2">
                <div class="col-md-12">
                        <h1>Failure Payments List </h1>
                   <p class='btn btn-primary'>Total Payments: <?= $totalUsers?></p>
                    
                    <!-- <a href="" class="btn btn-primary">Total Payments: <?= $totalUsers ?></a> -->
                </div>
            </div>
            <?php
                if (empty($today_pay)) {
                ?>
                    <div class="date_filter">

                        <table border="0" cellspacing="5" cellpadding="5">
                            <tbody>
                                <tr>
                                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <td style="font-size:20px;font-weight:20px;font-weight: bold;">Minimum date:</td><br>
                                        <td><input class="form-control" type="date" id="min" name="min"></td>
                                        <td style="font-size:20px; font-weight:20px;font-weight: bold;">Maximum date:</td><br>
                                        <td><input class="form-control" type="date" id="max" name="max"></td>
                                        <td>
                                            <button class="btn btn-success" type="submit" name="datefilter">Submit</button>
                                        </td>

                                    </form>
                                    <td>

                                        <form action="refresh.php" method="post">
                                            <button name="refresh_pay_fail" class="m-2 btn btn-info"> <i class="fa fa-refresh"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php

                } else {

                    echo "";
                }

                ?>
           
            <table class="table mt-5 border table-secondary payment-table" id="myTable">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>User Name</th>
                        <th>User Order Id</th>
                        <th>Total Amount</th>
                        <!-- <th>Payment Mode</th>
                        <th>Payment Type</th> -->
                        <!-- <th>Transaction No</th> -->
                        <th>Action</th>
                        <th>Status</th>
                        <!-- <th>View</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php

                        // $sql = "SELECT a.*, b.user_name FROM tbl_mst_user_payment_details as a LEFT JOIN tbl_mst_users as b ON a.user_for_id=b.user_id WHERE 1 $dateFilter ORDER BY user_pay_id DESC";

                        $sql = "SELECT a.*,b.order_uniq_id, c.user_name FROM reject_payments as a LEFT JOIN user_orders as b ON a.order_id=b.order_uniq_id LEFT JOIN tbl_mst_users as c ON b.or_user_for_id = c.user_id WHERE 1 $dateFilter ORDER BY a.payment_id DESC ";



                        // $sql = "SELECT * FROM user_orders as a LEFT JOIN order_payments as b ON a.payment_id =b.payment_id LEFT JOIN tbl_mst_users as c ON a.or_user_for_id = c.user_id WHERE 1 $dateFilter AND a.payment_id IS NOT NULL AND a.payment_id <> '' ORDER BY a.order_id DESC";


                 

                    $res = mysqli_query($con, $sql);
                    if ($res) {
                        $count = 0;
                        while ($row = mysqli_fetch_assoc($res)) {
                            $id = $row['order_id'];
                            $username = $row['user_name'];
                            $uniq_id = $row['order_uniq_id'];
                            $total = $row['amount'];
                            // $pay_mode = $row['user_pay_mode'];
                            // $pay_type = $row['user_pay_type'];
                            // $transaction_no = $row['user_pay_transactionNo'];
                            $status_mess = $row['status_message'];
                            $count++;
                    ?>
                            <tr>
                                <td><?= $count ?></td>
                                <td><?= $username ?></td>
                                <td><?= $uniq_id ?></td>
                                <td>₹ <?= $total ?></td>
                                <!-- <td><?= $pay_mode ?></td>
                                <td><?= $pay_type ?></td>
                                <td><?= $transaction_no ?></td> -->
                                <td>
                                    <a href="#" class="delete-btn" data-id="<?= $id ?>"><i class="fa-solid fa-trash-can btn btn-danger"></i></a>
                                </td>
                                <td>
                                    <?php
                                    // $statusButtonClass = ($row['order_status'] == 0) ? 'btn btn-success status' : 'btn btn-danger status';
                                    // $statusButtonText = ($row['order_status'] == 0) ? 'Paid' : 'Unpaid';

                                    // echo '<button class="' . $statusButtonClass . '" data-profile-id="' . $id . '">' . $statusButtonText . '</button>';
                                    ?>
                                    <p class='bg-info p-1 text-center text-white m-1' style='border-radius:5px'><?=$status_mess?></p>
                                   
                                    
                                    ?>
                                </td>
                                <!-- <td>
                                    <a href="view_payment?view=<?= $id ?>" class="btn btn-secondary">View</a>
                                </td> -->
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

<?php include('include/footer.php'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });

        $('.payment-table').on('click', 'button.status', function() {
            var button = $(this);
            var profileId = button.data('profile-id');
            var profileStatus = (button.hasClass('btn-success')) ? 1 : 0;

            Swal.fire({
                title: 'Confirmation',
                text: 'Are you sure you want to change payment the status?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'update_payment_status.php',
                        method: 'POST',
                        data: {
                            profileId: profileId,
                            profileStatus: profileStatus
                        },
                        success: function(response) {
                            if (response === 'success') {
                                if (profileStatus === 0) {
                                    button.removeClass('btn-danger').addClass('btn-success').text('Paid');
                                } else {
                                    button.removeClass('btn-success').addClass('btn-danger').text('Unpaid');
                                }
                                Swal.fire({
                                    title: 'Success',
                                    text: 'Status changed successfully!',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 800
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Failed to change status!',
                                    icon: 'error',
                                    showConfirmButton: false,
                                    timer: 800
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                }
            });
        });

        $('.payment-table').on('click', '.delete-btn', function() {
            var button = $(this);
            var profileId = button.data('id');

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
                        url: 'delete_payment.php',
                        method: 'POST',
                        data: {
                            profileId: profileId
                        },
                        success: function(response) {
                            if (response === 'success') {
                                button.closest('tr').remove();
                                Swal.fire({
                                    title: 'Success',
                                    text: 'Item deleted successfully!',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 800
                                }).then(() => {
                                    window.location.href = 'payments.php';
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
                            console.error(error);
                        }
                    });
                }
            });
        });
    });
</script>