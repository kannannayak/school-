<?php
include('include/header.php');
include('include/config.php');

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
                    <h3>NEWS</h3>
                    <!-- <a class="btn btn-primary">Total Subcategory: <?= $totalcategorys ?></a> -->
                    <a href="add_news" class="btn btn-success">Add News<strong>+</strong></a>
                </div>
                <div class="table-responsive">
                <table class="table mt-5 border table-secondary subcategory-table" id="myTable">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>NEWS type</th>
                            <!--<th>NEWS image</th>-->
                            <th>NEWS URL</th>
                            <th>NEWS Details</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `news` ORDER BY `news_id` DESC;";
                        $res = mysqli_query($con, $sql);
                        if ($res && mysqli_num_rows($res) > 0) {
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($res)) {
                                $id = $row['news_id'];
                                $news_name = $row['news_name'];
                                $news_image = $row['news_image'];
                                $news_url = $row['news_url'];
                                $news_details = $row['news_details'];
                             
                                $count++;

                        ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td><?= $news_name ?></td>
                                <!--<td><img src="../<?= $news_image ?>" alt="game type Image" style="width: 100px; height:100px;"></td>-->
                                    <td><?= $news_url ?></td>
                                    <td><?= $news_details ?></td>
                                   
                                <!--    <td>-->
                                <!--    <a href="#"  data-id ="<?= $id ?>" class="delete-btn"><i class="fa-solid fa-trash-can btn btn-danger"></i></a>-->
                                <!--    <a href="news_edit_add.php?edit=<?= $id?>" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>-->
                                <!--</td>-->
                                <td>
    <a href="#" data-id="<?= $id ?>" class="delete-btn"><i class="fa-solid fa-trash" style="color: #d41111;"></i></a>
    <a href="news_edit_add.php?edit=<?= $id?>"><i class="fa-solid fa-pen-to-square" style="color: #165ad0;"></i></a>
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
                'excelHtml5',
                // 'csvHtml5',
                // 'pdfHtml5'
            ],
            initComplete: function() {
                    this.api()
                        .columns()
                        .every(function(index) {
                            if (index !== 2 && index !== 4  ) { // Skip 2nd and 4th columns
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
            var  news_id = button.data('id');
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
                        url: 'update_sub_category_status.php',
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
            var news_id = button.data('id');

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
                        url: 'delete_news.php',
                        method: 'POST',
                        data: {
                            news_id: news_id,
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
                                window.location.href = 'table_news.php';
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