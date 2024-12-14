<?php
include("include/header.php");
include("include/conn.php");


 ?>

 <!-- begin MAIN PAGE CONTENT -->
<div id="page-wrapper" style="min-height:142vh;">
    <div class="page-content">
        <!-- begin PAGE TITLE ROW -->
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title">
                    <h1>ISDA Records</h1>
                </div>
                <div class="row">
                    <div class="col-lg-6" style="margin-bottom:10px;">
                        <div class="pull-left">
                            <a href="add_record.php" class="btn btn-success">Add New <strong>+</strong></a>
                        </div>
                    </div>

                </div>
                <table id="data_table" class=" display dataTable table table-striped table-bordered table-hover table-green">
                    <thead>
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Age</th>
                            <th scope="col">Game Type</th>
                            <th scope="col">Game Record</th>
                            
                            <th scope="col" class="text-center">Action </th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT isd.*,gen.gender_name,game.game_type_name
                        FROM `isda_records` AS isd 
                        JOIN `gender` AS gen ON isd.gender_id = gen.gender_id
                        JOIN `game_type_web` AS game ON isd.game_type_id = game.game_type_id
                        ORDER BY record_id  ";
                        $res = mysqli_query($conn, $sql);

                        if ($res) {
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($res)) {


                                $record_id  = $row['record_id'];
                                $name = $row['name'];
                                $gender_name = $row['gender_name'];
                                $age = $row['age'];
                                $game_type_name = $row['game_type_name'];
                                $game_timing = $row['game_timing'];
                              



                                $count = $count + 1;

                        ?>

                                <tr>
                                    <td><?= $count ?></td>
                                    <td><?= $name ?></td>
                                    <td><?= $gender_name ?></td>
                                    <td><?= $age ?></td>
                                    <td><?= $game_type_name ?></td>
                                    <td><?= $game_timing ?></td>
                                    <td style="display: flex;justify-content:space-evenly;">
                                        <a href="add_record.php?id=<?= $record_id ?>" class="text-default btn btn-warning "><i class="fa-solid fa-pen-to-square"></i></a>
                                       <a href="action/delete_record.php?id=<?= $record_id ?>" class="text-default btn btn-danger "><i class="fa fa-trash-o""></i></a>
                                    </td>




                                   
                                    

                                </tr>



                        <?php
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>
            <!-- /.col-lg-12 -->
            <div class="row">

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {

        $('#data_table').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'csv',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> CSV ',
                    title:'Campus Report',
                    titleAttr: 'DownLoad as CSV File',
                },
                {
                    extend: 'excel',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> Excel',
                    title:'Campus Report',
                    titleAttr:'Download as Excel File',
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> PDF',
                    title:'Campus Report',
                    titleAttr:'Download as PDF File',
                },
                {
                    extend: 'print',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> Print',
                    title:'Campus Report',
                    titleAttr:'Print User reports',
                },

            ]
        });

        
       
    })

</script>
</script>

<?php
include("include/footer.php");
?>

<script>
    <?php
    $msg = $_GET['msg'];
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