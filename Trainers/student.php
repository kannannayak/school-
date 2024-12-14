<?php
include("include/header.php");
include("include/conn.php");

// Step 1: Fetch distinct game types
$sql1 = "SELECT DISTINCT game_type_name FROM game_type_web";
$res1 = mysqli_query($conn, $sql1);

$game_types = [];
while ($row1 = mysqli_fetch_assoc($res1)) {
    $game_types[] = $row1['game_type_name'];
}
?>

<style>
    .profile {
        color: #102B6E !important;
        margin-top: 25px;
        margin-left: 50px;
    }
    body {
        background: #E6F4FB !important;
    }
    .heading {
        background: #0095DA !important;
        color: white;
        font-weight: 5px;
    }
    .bodyColor {
        background: #E6F4FB !important;
    }
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

<h4 class="profile">Records</h4>

<div class="table-responsive card">
    <table id="myTable" class="table display table-striped custom-table" width="100%">
        <thead>
            <tr class="heading">
                <th scope="col">SN</th>
                <th scope="col">Student Name</th>
                <th scope="col">Student Id</th>
                <th scope="col">Age</th>
                <th scope="col">Gender</th>
                <?php foreach ($game_types as $game_type): ?>
                    <th scope="col"><?= $game_type ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody class="bodyColor">
            <?php
            $tlog_id = $_SESSION['tlog_id'];
            $sql = "SELECT *
                    FROM users
                    JOIN trainer ON users.school_id = trainer.school_id
                    JOIN gender ON users.gender = gender.gender_id
                    WHERE trainer.tlog_id = '$tlog_id'";

            $res = mysqli_query($conn, $sql);
            if ($res && mysqli_num_rows($res) > 0) {
                $count = 0;
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['user_id'];
                    $user_name = $row['user_name'];
                    $gender_name = $row['sub_gender'];
                    $user_age = $row['age_in_months'];
                    $user_uniq_id = $row['user_uniq_id'];

                    // Initialize game_times array with 'N/A'
                    $game_times = array_fill_keys($game_types, 'N/A');

                    // Step 3: Adjust SQL query
                    $sql2 = "SELECT game_type_web.game_type_name, MIN(my_records.total_time) AS total_time 
                             FROM my_records 
                             JOIN game_type_web ON my_records.game_id = game_type_web.game_type_id 
                             WHERE my_records.user_id = $id 
                             GROUP BY game_type_web.game_type_name 
                             ORDER BY total_time";
                    $res2 = mysqli_query($conn, $sql2);

                    while ($row2 = mysqli_fetch_assoc($res2)) {
                        $game_times[$row2['game_type_name']] = $row2['total_time'];
                    }

                    $count++;
            ?>
                    <tr>
                        <th><?= $count ?></th>
                        <td><?= $user_name ?></td>
                        <td><?= $user_uniq_id ?></td>
                        <td><?= $user_age ?></td>
                        <td><?= $gender_name ?></td>
                        <?php foreach ($game_types as $game_type): ?>
                            <td><?= $game_times[$game_type] ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="<?= 5 + count($game_types) ?>" class="text-center">No Subcategories found.</td>
                </tr>
                <?php
            }
            ?>
        </tbody>
        <tfoot style="display: none;">
            <tr>
                <th><i class="fa-solid fa-magnifying-glass"></i></th>
                <th style="display:none"></th>
                <th></th>
                <th style="display:none"></th>
            </tr>
        </tfoot>
    </table>
</div>

<?php include("include/footer.php"); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> Excel',
                    title: 'Student Report',
                    titleAttr: 'Download as Excel File',
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> PDF',
                    title: 'Student Report',
                    titleAttr: 'Download as PDF File',
                }
            ],
            initComplete: function() {
                this.api().columns().every(function(index) {
                    if (index !== 16) { // Skip certain columns if needed
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
            'margin-top': '20px',
            'margin-left': '20px',
        });

        $('.dataTables_filter').css({
            'margin-top': '20px',
            'margin-right': '20px',
        });
    });
</script>
