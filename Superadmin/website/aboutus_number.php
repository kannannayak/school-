<?php
include('include/header.php');
include('include/config.php');
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
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

<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded justify-content-center mx-0">
        <div class="col-md-12">
            <div class="row my-2">
                <div class="col-md-12">
                    <h3>About Us Number</h3>
                </div>
            </div>
            <div class="date_filter">
                <div class="table-responsive">
                    <table class="table mt-5 border table-secondary product-table" id="myTable">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Students</th>
                                <th>Awards</th>
                                <th>Trainers</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM about_us_number";
                            $res = mysqli_query($con, $sql);

                            if ($res) {
                                $count = 0;
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $count++;
                                    ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo htmlspecialchars($row['Students']); ?></td>
                                        <td><?php echo htmlspecialchars($row['Awards']); ?></td>
                                        <td><?php echo htmlspecialchars($row['trainers']); ?></td>
                                        <td>
                                            <a href="aboutus_edit.php?about_id=<?php echo $row['about_id']; ?>">
                                                <i class="fa-solid fa-pen-to-square" style="color: #165ad0;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='5'>No data found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
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
            {
                extend: 'excel',
                className: 'btn btn-primary',
                text: '<i class="fa-solid fa-download"></i> Excel',
                title: 'Toplist',
                titleAttr: 'Download as Excel File',
            },
            {
                extend: 'pdf',
                className: 'btn btn-primary',
                text: '<i class="fa-solid fa-download"></i> PDF',
                title: 'Toplist',
                titleAttr: 'Download as PDF File',
            }
        ],
        initComplete: function() {
            this.api().columns().every(function(index) {
                if (index !== 4) {
                    let column = this;
                    let input = document.createElement('input');
                    input.placeholder = 'Search';
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
        'margin-bottom': '15px',
        'margin-left': '20px',
    });

    $('.product-table').on('click', '.delete-btn', function(e) {
        e.preventDefault();
        var button = $(this);
        var about_id = button.data('id');

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
                    url: 'delete_toplist.php',
                    method: 'POST',
                    data: { about_id: about_id },
                    success: function(response) {
                        if (response.trim() === 'success') {
                            button.closest('tr').remove();
                            Swal.fire({
                                title: 'Success',
                                text: 'Item deleted successfully!',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 800
                            }).then(() => {
                                window.location.reload();
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
