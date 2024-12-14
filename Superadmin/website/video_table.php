<?php
include('include/header.php');
include('include/config.php');

// Get total number of category users
// $Totalcategory = "SELECT COUNT(*) AS total_category FROM `tbl_mst_product_sub_category` WHERE sub_cat_isdeleted=0 ";
// $Totalcategory_result = mysqli_query($con, $Totalcategory);
// $rowTotalcategory = mysqli_fetch_assoc($Totalcategory_result);
// $totalcategorys = $rowTotalcategory['total_category'];
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

<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded  mx-0">
        <div class="col-md-12 ">
            <div class="row">
                <div class="col-md-6 mt-3 mb-3">
                    <h3>Video</h3>
                    
                    <a href="add_video" class="btn btn-success">Add Video<strong>+</strong></a>
                    <!--<a href="add_video_tu" class="btn btn-success">Add Video<strong>+</strong></a>-->
                </div>
                <div class="table-responsive">
                <table class="table mt-5 border table-secondary subcategory-table" id="myTable">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Title</th>
                            <!--<th>Tutorial Image</th>-->
                            <th>Video</th>
                            <th>Description</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `tutorial` ORDER BY `tut_id` DESC";
                        $res = mysqli_query($con, $sql);
                        if ($res && mysqli_num_rows($res) > 0) {
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($res)) {
                                $id = $row['tut_id'];
                                $tut_name= $row['tut_name'];
                                  $tut_url = $row['tut_url'];
                                	 $tut_details = $row['tut_details'];
                                
                                // $tutorial_web_image = $row['tutorial_web_image'];
                              
                                // $tutorial_web_url = $row['tutorial_web_url'];
                                // $tutorial_web_details= $row['tutorial_web_details'];
                                

                                $count++;

                        ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td><?= $tut_name ?></td>
                                    <!--<td><img src="../<?= $tutorial_web_image?>" alt="Tutorial Image" style="width: 100px;"></td>-->
                                   
                                    <!--<td><video width="320" height="240"  controls>-->
                                    <!--<source src="../<?= $tutorial_web_url ?>" type="video/mp4">-->
                                    <!--</video>-->
                                    <!--</td>-->
                                     <td><?=  $tut_url ?></td>
                                    <td><?=  $tut_details ?></td>
                                <!--    <td>-->
                                <!--    <a href="#"  data-id ="<?= $id ?>" class="delete-btn"><i class="fa-solid fa-trash-can btn btn-danger"></i></a>-->
                                <!--    <a href="edit_tutorial.php?edit=<?= $id ?>" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>-->
                                <!--</td>-->
                                 <td>
    <a href="#" data-id="<?= $id ?>" class="delete-btn"><i class="fa-solid fa-trash" style="color: #d41111;"></i></a>
        <a href="edit_video.php?edit=<?= $id ?>" ><i class="fa-solid fa-pen-to-square" style="color: #165ad0;"></i></a>
    
    
    <!--<a href="edit_tutorial.php?edit=<?= $id ?>" ><i class="fa-solid fa-pen-to-square" style="color: #165ad0;"></i></a>-->
</td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="7" class="text-center">No Subcategories found.</td>
                            </tr>
                        <?php
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
                // 'copyHtml5',
                // 'excelHtml5',
                // 'csvHtml5',
                // 'pdfHtml5'
            ],
            initComplete: function() {
                    this.api()
                        .columns()
                        .every(function(index) {
                            if (index !== 4 && index !== 2) { // Skip 2nd and 4th columns
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
 $('.dataTables_filter').css({
            'margin-bottom': '20px',
            'margin-right': '20px',
        });

        // Handle status change button click
        $('.subcategory-table').on('click', 'button.status', function() {
            var button = $(this);
            var game_type_id = button.data('id');
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
                        url: 'payments.php',
                        method: 'POST',
                        data: {
                            game_type_id: game_type_id,
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
        $('.subcategory-table').on('click', '.delete-btn', function() {
            var button = $(this);
            var id = button.data('id');

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
                        url: 'delete_video.php',
                        method: 'POST',
                        data: {
                            id: id,
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
                                window.location.href = 'video_table';
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