<?php
include("include/header.php");
include("include/conn.php");
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
<div id="page-wrapper" style="min-height:142vh;">
    <div class="page-content">
        <!-- begin PAGE TITLE ROW -->
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title">
                    <h1>Students Report</h1>
                </div>
                <div class="row">
                    <div class="col form-group" style="margin-bottom:10px;display: flex;justify-content: flex-end;">
                        <div>
                            <label style="font-size:14px;"><b> From</b></label>
                            <input id="dateFrom" type="date" autocomplete="off" name="dateFrom" placeholder="From Date" class="form-control filter bg-primary text-white datepicker">
                        </div>
                        <div>
                            <label style="font-size:14px;"><b>To</b></label>
                            <input id="dateTo" type="date" autocomplete="off" placeholder="To Date" name="dateTo" class="form-control filter bg-primary text-white pickerdate2">
                        </div>
                    </div>
                </div>

                <table id="data_table" class="display dataTable table table-striped table-bordered table-hover table-green">
                    <thead>
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Uniq id</th>
                            <th scope="col">Trainer</th>
                            <th scope="col">Age</th>
                            <th scope="col">Gender</th>
                            <th scope="col">School</th>
                            <th scope="col">Game Type</th>
                            <th scope="col">Time taken</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody id="data_table">
                        <?php
                        $sql = "SELECT rec.*, us.*, game.game_type_name,sch.school_name,tri.trainer_name,gen.gender_name 
                        FROM my_records AS rec
                        JOIN users AS us ON rec.user_id = us.user_id
                        JOIN school_list AS sch ON us.school_id = sch.school_id
                        JOIN trainer AS tri ON us.trainer_id = tri.trainer_id
                        JOIN game_type_web AS game ON rec.game_id = game.game_type_id
                        JOIN gender AS gen ON us.gender = gen.gender_id
                        WHERE rec.total_time IS NOT NULL
                        ORDER BY rec.record_id DESC";

                        $res = mysqli_query($conn, $sql);

                        if ($res) {
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($res)) {
                                $count++;
                                $id = $row['user_id'];
                                $user_uniq_id = $row['user_uniq_id'];
                                $user_name = $row['user_name'];
                                $parent_name = $row['parent_name'];
                                $trainer_name = $row['trainer_name'];
                                $user_age = $row['user_age'];
                                $gender_name = $row['gender_name'];
                                $school_name = $row['school_name'];
                                $game_type_name = $row['game_type_name'];
                                $total_time = $row['total_time'];
                                $date = date('d-m-Y', strtotime($row['created_dt']));
                        ?>
                                <tr>
                                    <td><?= $count ?></td>
                                    <td><?= $user_name ?></td>
                                    <td><?= $user_uniq_id ?></td>
                                    <td><?= $trainer_name ?></td>
                                    <td><?= $user_age ?></td>
                                    <td><?= $gender_name ?></td>
                                    <td><?= $school_name ?></td>
                                    <td><?= $game_type_name ?></td>
                                    <td><?= $total_time ?></td>
                                    <td><?= $date ?></td>
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
            <!-- /.col-lg-12 -->
        </div>
    </div>
</div>
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
        $('#data_table').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'csv',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> CSV ',
                    title: 'History Report',
                    titleAttr: 'Download as CSV File',
                },
                {
                    extend: 'excel',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> Excel',
                    title: 'History Report',
                    titleAttr: 'Download as Excel File',
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> PDF',
                    title: 'History Report',
                    titleAttr: 'Download as PDF File',
                },
                {
                    extend: 'print',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> Print',
                    title: 'History Report',
                    titleAttr: 'Print User reports',
                }
            ],
             initComplete: function() {
                    this.api()
                        .columns()
                        .every(function(index) {
                            if (index !== 13 ) { // Skip 2nd and 4th columns
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

        function updateTable() {
            var dateFrom = $("#dateFrom").val();
            var dateTo = $("#dateTo").val();

            console.log(dateFrom);
            console.log(dateTo);

            if (dateFrom !== '' && dateTo !== '') {
                var url = "payment_filter2.php?dateFrom=" + dateFrom + "&dateTo=" + dateTo;
                
                $.get(url, function(data) {
                    $("#myTable").html(data);
                }).fail(function() {
                    console.log("Error: Unable to fetch data.");
                });
            }
        }

        $("#dateFrom").change(updateTable);
        $("#dateTo").change(updateTable);
    });
</script>

<?php
include("include/footer.php");
?>

<script>
    <?php
    $msg = isset($_GET['msg']) ? $_GET['msg'] : '';
    if ($msg != '') {
    ?>
        swal("", "<?php echo $msg; ?>", "success");
        if (window.history.replaceState) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    <?php
    }
    ?>
</script>
