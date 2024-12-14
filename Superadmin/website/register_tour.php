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
<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded  mx-0">
        <div class="col-md-12 ">
            <div class="row">
                <div class="col-md-6 mt-3 mb-3">
                    <h3>Registered Student Details</h3>
                    <!-- <a class="btn btn-primary">Total Category: <?= $totalcategorys ?></a>
                    <a href="add_category" class="btn btn-success">Add <strong>+</strong></a> -->
                </div>
                <div class="table-responsive">
                <table class="table mt-5 border table-secondary category-table" id="myTable">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Trainer</th>
                            <th>Other Trainer</th>
                            <th>Tournament</th>
                            <th>Date Of Birth</th>
                            <th>Gender</th>
                            <th>Parent Name</th>
                            <th>School name</th>
                            <th>Phone</th>
                            <th>Action</th>
                            
                      
                           
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM tournament_register JOIN tournament ON tournament_register.tournament=tournament.tourn_id order by tournament_register.tourn_id DESC;
                        
               ";
                        $res = mysqli_query($con, $sql);
                        if ($res && mysqli_num_rows($res) > 0) {
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($res)) {
                                // $id = $row['cat_id'];
                                $id= $row["id"];
                                $name=$row['name'];
                                
                                $gender = $row['gender'];
                                $short_gender = '';

if ($gender == 'female') {
    $short_gender = 'F';
} elseif ($gender == 'male') {
    $short_gender = 'M';
}
                                $dob = $row['dob'];
                                $tourn_name = $row['tourn_name'];
                                $parent_name = $row['parent_name'];
                                $phone = $row['phone'];
                                $schl_name = $row['schl_name'];
                                $trainer_id = $row['trainer_id'];
                                $otherCoach = $row['otherCoach'];
                               
                              
                                $count++;

                        ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td><?= $name ?></td>
                                    <td><?= $trainer_id ?></td>
                                     <td><?= $otherCoach ?></td>
                                    <td><?= $tourn_name ?></td>
                                    <td><?= $dob ?></td>
                                    <td><?= $short_gender ?></td>
                                    <td><?= $parent_name ?></td>
                                    <td><?= $schl_name ?></td>
                                    <td><?= $phone ?></td>
                                    <td>
                                    <a href="#"  data-id ="<?= $id ?>" class="delete-btn"><i class="fa-solid fa-trash" style="color: #d41111;"></i></a>
                                    <a href="show_tour.php?edit=<?= $id ?>" ><i class="fa-solid fa-eye"></i></a>
                                       </td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                           
 


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
<!-- Blank End -->

<?php include('include/footer.php') ?>

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
                //     title: 'Registered Student Details',
                //     titleAttr: 'Student Register Details',
                // },
                {
                    extend: 'excel',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> Excel',
                    title: 'Registered Student Details',
                    titleAttr: 'Student Register Details',
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> PDF',
                    title: 'Registered Student Details',
                    titleAttr: 'Student Register Details',
                }
            ],
            initComplete: function() {
                    this.api()
                        .columns()
                        .every(function(index) {
                            if (index !== 10) { // Skip 2nd and 4th columns
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
            'margin-bottom': '15px',
            'margin-left': '20px',
        });

        $('.dataTables_filter').css({
            'margin-bottom': '20px',
            'margin-right': '20px',
        });
        
        $('.category-table').on('click', '.delete-btn', function(e) {
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
                        url: 'delete_register.php',
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