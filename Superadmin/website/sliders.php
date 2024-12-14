<?php
include('include/header.php');
include('include/config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css">

<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded mx-0">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 mt-3 mb-3">
                    <h3>Upload image</h3>
                    <a href="add_slider.php" class="btn btn-success">Add image</a>
                </div>
                <div class="table-responsive">
                    <table class="table mt-5 border table-secondary subcategory-table" id="myTable">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Slider Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM `web_slider_img` ORDER BY `img_id` DESC";
                            $res = mysqli_query($con, $sql);
                            if ($res && mysqli_num_rows($res) > 0) {
                                $count = 0;
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $img_id = $row['img_id'];
                                    $web_img = $row['web_img'];
                                    $count++;
                            ?>
                                    <tr>
                                        <td><?= $count ?></td>
                                        <td><img src="../<?= $web_img ?>" alt="Slider Image" style="width: 100px; height:100px;"></td>
                                        <td>
                                            <a href="#" data-id="<?= $img_id ?>" class="delete-btn"><i class="fa-solid fa-trash" style="color: #d41111;"></i></a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                            ?>
                                <tr>
                                    <td colspan="3" class="text-center">No Slider found.</td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blank End -->

<?php include('include/footer.php') ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.js"></script>

<script>
    $(document).ready(function() {
    $('#myTable').DataTable({
        dom: 'Bfrtip',
        buttons: []
    });

    // Handle delete button click event
    $('.subcategory-table').on('click', '.delete-btn', function(e) {
        e.preventDefault();
        var button = $(this);
        var img_id = button.data('id');

        // Display confirmation dialog using SweetAlert
        Swal.fire({
            title: 'Confirmation',
            text: 'Are you sure you want to delete this item?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                // Send AJAX request to delete the slider
                $.ajax({
                    url: 'delete_slider.php',
                    method: 'POST',
                    data: { img_id: img_id },
                    success: function(response) {
                        // Ensure response is exactly 'success'
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
