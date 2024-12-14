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
    width: 200%;
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
                    <h3>Game Types</h3>
                    <!-- <a class="btn btn-primary">Total Subcategory: <?= $totalcategorys ?></a> -->
                    <a href="add_game" class="btn btn-success">Add Game <strong>+</strong></a>
                </div>
                <div class="table-responsive">
                <table class="table mt-5 border table-secondary subcategory-table" id="myTable">
                    <thead>
                        <tr>
                            <th width="60px">S.No</th>
                            <th></th>
                            <th width="60px">game type</th>
                            <th></th>
                            <!--<th>game image</th>-->
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `game_type_web`";
                        $res = mysqli_query($con, $sql);
                        if ($res && mysqli_num_rows($res) > 0) {
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($res)) {
                                $id = $row['game_type_id'];
                                $game_type_name = $row['game_type_name'];
                                $game_type_img = $row['game_type_img'];
                                $count++;

                        ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td></td>
                                    <td><?= $game_type_name ?></td>
                                    <td></td>
                                    <!--<td><img src="../<?= $game_type_img ?>" alt="game type Image" style="width: 100px; height:100px;"></td>-->
                                <!--    <td>-->
                                <!--    <a href="#"  data-id ="<?= $id ?>" class="delete-btn"><i class="fa-solid fa-trash-can btn btn-danger"></i></a>-->
                                <!--    <a href="game_edit.php?edit=<?= $id?>" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>-->
                                <!--</td>-->
                                 <td>
    <a href="#" data-id="<?= $id ?>" class="delete-btn"><i class="fa-solid fa-trash" style="color: #d41111;"></i></a>
    <a href="game_edit.php?edit=<?= $id ?>"><i class="fa-solid fa-pen-to-square" style="color: #165ad0;"></i></a>
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
                //     title: 'Game Types',
                //     titleAttr: 'Download as CSV File',
                // },
                {
                    extend: 'excel',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> Excel',
                    title: 'Game Types',
                    titleAttr: 'Download as Excel File',
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> PDF',
                    title: 'Game Types',
                    titleAttr: 'Download as PDF File',
                }
            ],
            initComplete: function() {
                    this.api()
                        .columns()
                        .every(function(index) {
                            if (index !== 1 && index !== 3 && index !== 4) { // Skip 2nd and 4th columns
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
        
        //  new DataTable('#myTable', {
        //     "language": {
        //         "search": "",
        //         searchPlaceholder: "Search records",
        //     },
        //     dom: 'Bfrtip',
        //     buttons: [
        //         {
        //             extend: 'csv',
        //             className: 'btn btn-primary',
        //             text: '<i class="fa-solid fa-download"></i> CSV ',
        //             title: 'Game Types',
        //             titleAttr: 'Download as CSV File',
        //         },
        //         {
        //             extend: 'excel',
        //             className: 'btn btn-primary',
        //             text: '<i class="fa-solid fa-download"></i> Excel',
        //             title: 'Game Types',
        //             titleAttr: 'Download as Excel File',
        //         },
        //         {
        //             extend: 'pdf',
        //             className: 'btn btn-primary',
        //             text: '<i class="fa-solid fa-download"></i> PDF',
        //             title: 'Game Types',
        //             titleAttr: 'Download as PDF File',
        //         }
        //     ],

        //     initComplete: function() {
        //         this.api()
        //             .columns()
        //             .every(function() {
        //                 let column = this;
        //                 let title = column.footer().textContent;
        //                 // Create input element
        //                 let input = document.createElement('input');
        //                 input.placeholder = title;
        //                 column.header().append(input);

        //                 // Event listener for user input
        //                 input.addEventListener('keyup', () => {
        //                     if (column.search() !== input.value) {
        //                         column.search(input.value).draw();
        //                     }
        //                 });
        //             });
        //     }
        // });


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

        // Handle delete button click event
        $('.subcategory-table').on('click', '.delete-btn', function(e) {
            e.preventDefault();
            var button = $(this);
            var game_type_id = button.data('id');

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
                        url: 'delete_game.php',
                        method: 'POST',
                        data: { game_type_id: game_type_id },
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