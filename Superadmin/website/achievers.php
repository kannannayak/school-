<?php
include('include/header.php');
include('include/config.php');
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css">
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
                    <h3>Achievers</h3>
                    <div class="col-md-6 mt-3 mb-3">
                    
                    <a href="add_achiever.php" class="btn btn-success">Add +</a>
                </div>
                </div>
            </div>
            <div class="date_filter">
                <div class="table-responsive">
                    <table class="table mt-5 border table-secondary product-table" id="datatable">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Location</th>
                                <th>Image</th>
                                <th>Game</th>
                                <th>Timing</th>
                                
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM achievers";
                            $res = mysqli_query($con, $sql);

                            if ($res) {
                                $count = 0;
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $count++;
                                    $image = $row['image'];
                                    $acheiver_id = $row['acheiver_id'];
                                    ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['age']); ?></td>
                                        <td><?php echo htmlspecialchars($row['location']); ?></td>
                                        <td><img src="../<?= $image ?>" alt="Achiever Image" style="width: 50px; height:50px;"></td>
                                        <td><?php echo htmlspecialchars($row['game']); ?></td>
                                         <td><?php echo htmlspecialchars($row['timing']); ?></td>
                                       
                                          <td>
                                            <a href="#" data-id="<?= $acheiver_id ?>" class="delete-btn"><i class="fa-solid fa-trash" style="color: #d41111;"></i></a>
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
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.js"></script>

<script>
$(document).ready(function() {
    // Check if the DataTable is already initialized before reinitializing
    if (!$.fn.DataTable.isDataTable('#datatable')) {
        $('#datatable').DataTable({
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
                    if (index !== 4) { // Exclude the image column from the search
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

        // Apply custom styles to buttons
        $('.dt-button').css({
            'background': '#0191D6',
            'color': '#fff',
            'border-radius': '5px',
            'font-size': '15px',
            'margin-bottom': '15px',
            'margin-left': '20px',
        });
    }

    // Handle delete button click
    $('#datatable').on('click', '.delete-btn', function(e) {
        e.preventDefault();
        var button = $(this);
        var acheiver_id = button.data('id');

        // Confirmation dialog using SweetAlert
        Swal.fire({
            title: 'Confirmation',
            text: 'Are you sure you want to delete this item?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                // AJAX request to delete the achiever
                $.ajax({
                    url: 'delete_achiever.php',
                    method: 'POST',
                    data: { acheiver_id: acheiver_id },
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
                                text: 'An error occurred while deleting the item.',
                                icon: 'error',
                                showConfirmButton: true
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        Swal.fire({
                            title: 'Error',
                            text: 'An error occurred while deleting the item.',
                            icon: 'error',
                            showConfirmButton: true
                        });
                    }
                });
            }
        });
    });
});
</script>
