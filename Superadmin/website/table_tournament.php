<?php
include('include/header.php');
include('include/config.php');

// Initialize $dateFilter variable
$dateFilter = "";
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

<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded justify-content-center mx-0">
        <div class="col-md-12">
             <div class="row my-2">
                <div class="col-md-12">
                    <h3>Torunament</h3>
                    <!-- <a href="add_banner" class="btn btn-success">Add +</a> -->
                </div>
            </div>
            <div class="row my-2">
                <div class="col-md-12">
                    <a href="tournament.php" class="btn btn-success">Add Tournament<strong>+</strong></a>
                </div>
            </div>
            <div class="date_filter">
                <table border="0" cellspacing="5" cellpadding="5">
                    <tbody>
                        <tr></tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive">        
                <table class="table mt-5 border table-secondary product-table" id="myTable">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Tournament Type</th>
                            <th>Game Type</th>
                            <th>Tournament Name</th>
                            <th>Tournament Date</th>
                            <th>Tournament Venue</th>
                           
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `tournament` 
                         JOIN game_type_web AS game ON game.game_type_id = tournament.game_type 
                         ORDER BY `tourn_date` ASC";
                        $res = mysqli_query($con, $sql);
                        if ($res) {
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($res)) {
                                $tourn_id = $row['tourn_id'];
                                $tourn_type= $row['tourn_type'];
                                $game_type= $row['game_type_name'];
                                $tourn_name = $row['tourn_name'];
                             $tourn_date = date("d-m-Y", strtotime($row['tourn_date']));
                                $tourn_details=$row['tourn_details'];
                                $tourn_image=$row['tourn_image'];
                                $count++;
                        ?> 
                            <tr>
                                <td><?= $count ?></td>
                                <td><?= $tourn_type ?></td>
                                <td><?= $game_type ?></td>
                                <td><?= $tourn_name?></td>
                                <td><?=  $tourn_date ?></td>
                                  <td><?=  $tourn_details ?></td>
                                   
                                <!--<td>-->
                                <!--    <a href="#" data-id="<?= $tourn_id ?>" class="delete-btn"><i class="fa-solid fa-trash" style="color: #d41111;"></i></a>-->
                                <!--    <a href="tournament_edit.php?edit=<?= $tourn_id ?>"><i class="fa-solid fa-pen-to-square" style="color: #165ad0;"></i></a>-->
                                <!--</td>-->
                                  <td>
    <a href="#" data-id="<?= $tourn_id ?>" class="delete-btn"><i class="fa-solid fa-trash" style="color: #d41111;"></i></a>
    <a href="tournament_edit.php?edit=<?= $tourn_id ?>" ><i class="fa-solid fa-pen-to-square" style="color: #165ad0;"></i></a>
</td>
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
                //     title: 'Tournament Details',
                //     titleAttr: 'Tournament Details',
                // },
                {
                    extend: 'excel',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> Excel',
                    title: 'Tournament Details',
                    titleAttr: 'Tournament Details',
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> PDF',
                    title: 'Tournament Details',
                    titleAttr: 'Tournament Details',
                }
            ],
            initComplete: function() {
                    this.api()
                        .columns()
                        .every(function(index) {
                            if (index !== 6 && index !== 7) { // Skip 2nd and 4th columns
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
       $('.product-table').on('click', '.delete-btn', function() {
            var button = $(this);
            var tourn_id = button.data('id');

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
                        url: 'delete_tournament.php',
                        method: 'POST',
                        data: { tourn_id: tourn_id },
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


                    });
                }
            });
        });
    });
    </script>

