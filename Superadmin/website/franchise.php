<?php
include('include/header.php');
include('include/config.php');

// $TotalUser = "SELECT COUNT(*) AS total_products FROM `tbl_mst_order_return_details` WHERE return_order_items_isdeleted = 0 ";
// $TotalUsers_result = mysqli_query($con, $TotalUser);
// $rowTotalUsers = mysqli_fetch_assoc($TotalUsers_result);
// $totalUsers = $rowTotalUsers['total_products'];


?>
<style>
.custom-input-class {
    width: 100%;
    height: 30px;
    padding: 5px;
    box-sizing: border-box; /* Ensure padding and border are included in the height */
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
}

    </style>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css">

<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded justify-content-center mx-0">
        <div class="col-md-12">
            <div class="row my-2">
                <div class="col-md-12">
                    <h3>Comments</h3>
                    <!-- <a href="add_banner" class="btn btn-success">Add +</a> -->
                </div>
            </div>
         <div class="table-responsive">
            <table class="table mt-5 border table-secondary banner-table" id="myTable">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Investment</th>
                        <th>State</th>
                        <th>District</th>
                        <th>Date</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT fan.*
                    FROM franchise_register AS fan ORDER BY franchise_id DESC";

                    $res = mysqli_query($con, $sql);
                    if ($res) {
                        $count = 0;
                        while ($row = mysqli_fetch_assoc($res)) {
                            $franchise_id = $row['franchise_id'];
                            $name = $row['name'];
                            $email_id = $row['email_id'];
                            $phone_number = $row['phone_number'];
                            $investment = $row['investment'];
                            $state = $row['state'];
                            $city = $row['city'];
                            $date = $row['date'];
                            
                            $count++;
                    ?>
                            <tr>
                                <td><?= $count ?></td>
                                <td><?= $name ?></td>
                                <td><?= $email_id ?></td>
                                <td><?= $phone_number ?></td>
                                <td><?= $investment ?></td>
                                <td><?= $state ?></td>
                                <td><?= $city ?></td>
                                <td><?= $date ?></td>
                               
<!--                                <td>-->
<!--      <a href="#" data-id="<?= $id ?>" class="delete-btn"><i class="fa-solid fa-trash" style="color: #d41111;"></i></a>-->
<!--    <a href="edits_comments.php?edit=<?= $id ?>" ><i class="fa-solid fa-eye"></i></a>-->
<!--</td>-->
                               
                               
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
                 <tfoot style="display: none;">
                        <tr>
                            <th> <i class="fa-solid fa-magnifying-glass"></i></th>
                            <th style="display:none"> </th>
                            <th> </th>
                           <th style="display:none"> </th>
 
                            
                        </tr>
                </tfoot>
            </table>
            </div>
        </div>
    </div>
</div>

<?php include('include/footer.php'); ?>

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
                // {
                //     extend: 'csv',
                //     className: 'btn btn-primary',
                //     text: '<i class="fa-solid fa-download"></i> CSV ',
                //     title: 'Comments',
                //     titleAttr: 'Download as CSV File',
                // },
                {
                    extend: 'excel',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> Excel',
                    title: 'Comments',
                    titleAttr: 'Download as Excel File',
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> PDF',
                    title: 'Comments',
                    titleAttr: 'Download as PDF File',
                }
            ],
               initComplete: function() {
                    this.api()
                        .columns()
                        .every(function(index) {
                            if (index !== 8 ) { // Skip 2nd and 4th columns
                                let column = this;
                                let title = $(column.footer()).text();
                                let input = document.createElement('input');
                                input.placeholder = title;
                                input.className = 'custom-input-class';
                                input.style.width = '100%'; 
                                // input.style.height = '30px'; 
                                input.style.padding = '5px';
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
            'margin-bottom': '15px',
            'margin-left': '20px',
        });

        $('.dataTables_filter').css({
            'margin-bottom': '20px',
            'margin-right': '20px',
        });

        $('.banner-table').on('click', '.delete-btn', function(e) {
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
                        url: 'del_comments.php',
                        method: 'POST',
                        data: { id: id },
                        success: function(response) {
                            if (response.trim() === 'success') {
                                button.closest('tr').remove();
                                Swal.fire({
                                    title: 'Success',
                                    text: 'Item deleted successfully!',
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