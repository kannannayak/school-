<?php
include('include/header.php');
include('include/config.php');

$TotalUser = "SELECT COUNT(*) AS total_retail_orders FROM `tbl_mst_user_order_details` WHERE order_isdeleted=0";
$TotalUsers_result = mysqli_query($con, $TotalUser);
$rowTotalUsers = mysqli_fetch_assoc($TotalUsers_result);
$totalUsers = $rowTotalUsers['total_retail_orders'];



// Initialize $dateFilter variable
$dateFilter = "";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $minDate = $_POST['min'];
    $maxDate = $_POST['max'];



    // Create the date filter for the SQL query
    if ($minDate && $maxDate) {
        $minDate = date("Y-m-d", strtotime($minDate));
        $maxDate = date("Y-m-d", strtotime($maxDate));
        $dateFilter = "AND order_date BETWEEN '$minDate' AND '$maxDate'";
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
                    <a href="" class="btn btn-primary">Total Retail Order: <?= $totalUsers ?></a>
                    <h3>All Retail Order Details</h3>
                    <a href="add_product.php" class="btn btn-success">Add <strong>+</strong></a>
                </div>
            </div>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <table border="0" cellspacing="5" cellpadding="5">
                    <tbody>
                        <tr>
                            <td style="font-size:20px;font-weight:20px;font-weight: bold;">Minimum date:</td><br>
                            <td><input class="form-control" type="date" id="min" name="min"></td>
                            <td style="font-size:20px; font-weight:20px;font-weight: bold;">Maximum date:</td><br>
                            <td><input class="form-control" type="date" id="max" name="max"></td>
                            <td>
                                <button class="btn btn-success" type="submit">Submit</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
            <table class="table mt-5 border table-secondary order_table" id="myTable">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>User Name</th>
                        <th>Product Name</th>
                        <th>Billing Name</th>
                        <th>Billing Address</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT a.*,b.user_name FROM tbl_mst_user_order_details as a LEFT JOIN tbl_mst_users as b ON a.user_for_id=b.user_id WHERE order_isdeleted = 0 AND order_type = 'retail' $dateFilter ORDER BY user_order_id DESC ";

                    $res = mysqli_query($con, $sql);
                    if ($res) {
                        $count = 0;
                        while ($row = mysqli_fetch_assoc($res)) {
                            $id = $row['user_order_id'];
                            $user_name = $row['user_name'];
                            $product_name = $row['pro_name'];
                            $bill_name = $row['billing_name'];
                            $bill_address = $row['billing_address'];
                            $status = $row['order_status'];

                            // Set button class and status text based on status
                            $statusButtonClass = "";
                            $statusText = "";

                            switch ($status) {
                                case 0:
                                    $statusButtonClass = "btn btn-danger status";
                                    $statusText = "Pending";
                                    break;
                                case 1:
                                    $statusButtonClass = "btn btn-warning status";
                                    $statusText = "Processing";
                                    break;
                                case 2:
                                    $statusButtonClass = "btn btn-success status";
                                    $statusText = "Delivered";
                                    break;
                            }
                            $count++;
                    ?>
                            <tr>
                                <td><?= $count ?></td>
                                <td><?= $user_name ?></td>
                                <td><?= $product_name ?></td>
                                <td><?= $bill_name ?></td>
                                <td><?= $bill_address ?></td>
                               
                                <td>
                                    <a href="view_retail_order?view=<?= $id ?>" class="btn btn-secondary">View</a>
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


    });
</script>