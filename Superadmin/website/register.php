<?php
include('include/header.php');
include('include/config.php');

// Get total number of category users
// $Totalcategory = "SELECT COUNT(*) AS total_category FROM `tbl_mst_product_category` WHERE cat_isdeleted=0 ";
// $Totalcategory_result = mysqli_query($con, $Totalcategory);
// $rowTotalcategory = mysqli_fetch_assoc($Totalcategory_result);
// $totalcategorys = $rowTotalcategory['total_category'];
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css">

<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded  mx-0">
        <div class="col-md-12 ">
            <div class="row">
                <div class="col-md-6 mt-3 mb-3">
                    <h3>Registration Details</h3>
                    <!-- <a class="btn btn-primary">Total Category: <?= $totalcategorys ?></a>
                    <a href="add_category" class="btn btn-success">Add <strong>+</strong></a> -->
                </div>

                <table class="table mt-5 border table-secondary category-table" id="myTable">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Email</th>
                            
                           <th>Tournamnet</th>
                        
                            <th>Phone</th>
                            
                      
                           
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `registerform`";
                        $res = mysqli_query($con, $sql);
                        if ($res && mysqli_num_rows($res) > 0) {
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($res)) {
                                // $id = $row['cat_id'];
                                $name=$row['name'];
                                $email = $row['email'];
                                $gender = $row['gender'];
                                $age = $row['age'];
                                $tournament = $row['tournament'];
                                $grade = $row['grade'];
                                $phone = $row['phone'];
                                $schoolname = $row['schoolname'];
                                $address = $row['address'];
                                $district= $row['district'];
                                $pincode = $row['pincode'];
                              
                                $count++;

                        ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td><?= $name ?></td>
                                    <td><?= $email ?></td>
                                  
                                  
                                    <td><?= $tournament ?></td>
                                   
                                    <td><?= $phone ?></td>
                                    
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                           
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
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
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });

        // Handle status change button click
        $('.category-table').on('click', 'button.status', function() {
            var button = $(this);
            var profileId = button.data('profile-id');
            var profileStatus = (button.hasClass('btn-success')) ? 1 : 0;

            // Display confirmation dialog using SweetAlert
            Swal.fire({
                title: 'Confirmation',
                text: 'Are you sure you want to change the status?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send AJAX request to update profile status
                    $.ajax({
                        url: 'update_category_status.php',
                        method: 'POST',
                        data: {
                            profileId: profileId,
                            profileStatus: profileStatus
                        },
                        success: function(response) {
                            // Update button style and text
                            if (profileStatus === 0) {
                                button.removeClass('btn-danger').addClass('btn-success').text('Active');
                            } else {
                                button.removeClass('btn-success').addClass('btn-danger').text('Inactive');
                            }
                            // Show success message
                            Swal.fire({
                                title: 'Success',
                                text: 'Status changed successfully!',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 800
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                }
            });
        });

        // ...

        // Handle delete button click event
        $('.category-table').on('click', '.delete-btn', function() {
            var button = $(this);
            var profileId = button.data('id');

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
                    // Send AJAX request to delete category user
                    $.ajax({
                        url: 'delete_category.php',
                        method: 'POST',
                        data: {
                            profileId: profileId
                        },
                        success: function(response) {
                            // Remove the row from the table
                            button.closest('tr').find('td').addClass('disabled');
                            button.remove();

                            // Show success message
                            Swal.fire({
                                title: 'Success',
                                text: 'Item deleted successfully!',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 800
                            }).then(() => {
                                // Redirect to the same page
                                window.location.href = 'category';
                            });
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