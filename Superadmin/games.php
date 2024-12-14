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
                    <h1>Game List</h1>
                </div>
                <div class="row">
                    <div class="col-lg-6" style="margin-bottom:10px;">
                        <div class="pull-left">
                            <a href="add_game.php" class="btn btn-success">Add New <strong>+</strong></a>
                        </div>
                    </div>

                </div>
                <table id="data_table" class=" display dataTable table table-striped table-bordered table-hover table-green">
                    <thead>
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Game Name</th>
                            <th scope="col">Created Date</th>
                           
                            <th scope="col" class="text-center">Action </th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `game_type_web`" ;
                      
                        $res = mysqli_query($conn, $sql);

                        if ($res) {
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($res)) {


                                $game_id  = $row['game_type_id'];
                                $name = $row['game_type_name'];
                                $game_type_createed_dt = $row['game_type_createed_dt'];
                                $game_status = $row['game_status'];
                              
                              



                                $count = $count + 1;

                        ?>
                            <tr>
                                <td><?= $count ?></td>
                                <td><?= $name ?></td>
                                <td><?= $game_type_createed_dt ?></td>
                                <!--<td >-->
                                <!--    <button class="text-default btn btn-success">Active</button>-->
                                <!--    <button class="text-default btn btn-danger">Inactive</button>-->
                                <!--</td>-->
                                <td style="display: flex; justify-content: space-evenly;">
                                    <a href="add_game.php?id=<?= $game_id ?>" class="text-default btn btn-warning">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="action/delete_game.php?id=<?= $game_id ?>" class="text-default btn btn-danger">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
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