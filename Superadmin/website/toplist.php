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
                    <h3>Toplist</h3>
                    <a href="add_toplist.php" class="btn btn-success">Add <strong>+</strong></a>
                </div>
            </div>
            <div class="date_filter">
                <div class="table-responsive">
                    <table class="table mt-5 border table-secondary product-table" id="myTable">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Game</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Time</th>
                                <th>School</th>
                                <th>Year</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT top.*, game.game_type_name, sch.school_name 
                                    FROM topers_list_web AS top 
                                    JOIN game_type_web AS game ON game.game_type_id = top.game_id 
                                    JOIN school_list AS sch ON top.school_id = sch.school_id
                                    ORDER BY top.game_id DESC";

                            $res = mysqli_query($con, $sql);

                            if ($res) {
                                $count = 0;
                                while ($row = mysqli_fetch_assoc($res)) {
                                    // Debug: Uncomment to check data being fetched
                                    // echo "<pre>"; print_r($row); echo "</pre>";

                                    $toper_id = $row['toper_id'];
                                    $game_type_name = $row['game_type_name'];
                                    $name = $row['name'];
                                    $age = $row['age'];
                                    $school_name = $row['school_name'];
                                    $gender = $row['gender'];
                                    $short_gender = ($gender == 'Female') ? 'F' : 'M';
                                    $time = $row['time'];
                                    $year = $row['year'];
                                    $count++;
                            ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $game_type_name; ?></td>
                                        <td><?php echo $name; ?></td>
                                        <td><?php echo $age; ?></td>
                                        <td><?php echo $short_gender; ?></td>
                                        <td><?php echo $time; ?></td>
                                        <td><?php echo $school_name; ?></td>
                                        <td><?php echo $year; ?></td>
                                        <td>
                                            <a href="#" data-id="<?php echo $toper_id; ?>" class="delete-btn"><i class="fa-solid fa-trash" style="color: #d41111;"></i></a>
                                            <a href="toplist_edit.php?edit=<?php echo $toper_id; ?>"><i class="fa-solid fa-pen-to-square" style="color: #165ad0;"></i></a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='9'>No data found</td></tr>";
                            }
                            ?>
                        </tbody>
                        <tfoot style="display: none;">
                            <tr>
                                <th> <i class="fa-solid fa-magnifying-glass"></i></th>
                                <th style="display:none"></th>
                                <th></th>
                                <th style="display:none"></th>
                            </tr>
                        </tfoot>
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
                if (index !== 7) { // Skip columns where no filter is needed
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

    $('.product-table').on('click', '.delete-btn', function(e) {
        e.preventDefault();
        var button = $(this);
        var toper_id = button.data('id');

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
                    data: { toper_id: toper_id },
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