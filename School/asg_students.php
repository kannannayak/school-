<?php
include("include/header.php");
include("include/conn.php");


 ?>


<div id="page-wrapper" style="min-height:142vh;">
    <div class="page-content">
        <!-- begin PAGE TITLE ROW -->
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title">
                    <h1>Assign Coordinator </h1>
                </div>
                <div class="row">
                    <div class="col-lg-6" style="margin-bottom:10px;">
                        <div class="pull-left">
                            <a href="assign_students" class="btn btn-success">Assign <strong>+</strong></a>
                        </div>
                    </div>

                </div>
                <!-- <table id="data_table" class=" display dataTable table table-striped table-bordered table-hover table-green">
                    <thead>
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Cooredinator Name</th>
                            <th scope="col">Routes</th>
                            <th scope="col">Drivers</th>
                            <th scope="col">Vehicles</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // $sql = "SELECT a.*,b.coord_name FROM `assign_coord` AS a JOIN `coordinator` AS b ON a.`coord_id` = b.`coord_id`";
                        // $res = mysqli_query($conn, $sql);

                        // if ($res) {
                        //     $count = 0;
                        //     while ($row = mysqli_fetch_assoc($res)) {

                        //         $routes_ids = explode(',', $row['routes_id']);
                        //         $drivers_ids = explode(',', $row['drivers_id']);
                        //         $vehicles_ids = explode(',', $row['vehicles_id']);

                        //         $coord_name = $row['coord_name'];

                        //         $asg_coord_id = $row['asg_coord_id'];

                        //         $routerow_count = 0;
                        //         $driverow_count = 0;
                        //         $vehirow_count = 0;

                        //         foreach ($routes_ids as $key => $route_id) {


                        //             $routesql = "SELECT * FROM `createroute` WHERE `route_id` = $route_id";
                        //             $routeres = mysqli_query($conn, $routesql);

                        //             while (mysqli_fetch_assoc($routeres)) {
                        //                 $routerow_count++;
                        //             }
                        //         }

                        //         foreach ($drivers_ids as $key => $driver_id) {
                        //             $drivesql = "SELECT * FROM `driver` WHERE `driver_id` = $driver_id";
                        //             $driveres = mysqli_query($conn, $drivesql);

                        //             while (mysqli_fetch_assoc($driveres)) {
                        //                 $driverow_count++;
                        //             }
                        //         }

                        //         foreach ($vehicles_ids as $key => $vehicle_id) {


                        //             $vehisql = "SELECT * FROM `vehicle_details` WHERE `vehicle_id` = $vehicle_id";
                        //             $vehires = mysqli_query($conn, $vehisql);
                        //             while (mysqli_fetch_assoc($vehires)) {
                        //                 $vehirow_count++;
                        //             }
                        //         }


                        //         $count = $count + 1;
                        // ?>

                        //         <tr>
                        //             <td><?= $count ?></td>
                        //             <td><?= $coord_name ?></td>
                        //             <td><?= $routerow_count ?></td>
                        //             <td><?= $driverow_count ?></td>
                        //             <td><?= $vehirow_count ?></td>


                        //             <td class="text-center">

                        //                 <a href="assign_coord_view.php?id=<?= $asg_coord_id ?>" class="text-default btn btn-primary "><i class="fa-solid fa-eye"></i></a>
                        //                 <a href="add_assign_coord?ass_id=<?php echo $asg_coord_id; ?>" class="text-default btn btn-warning "><i class="fa-solid fa-pen-to-square"></i></a>
                        //                 <a href="action/delete_assign_coord?id=<?php echo $asg_coord_id; ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>

                        //             </td>


                        //         </tr>




                        // <?php
                        //     }
                        // }
                        ?>
                    </tbody>
                </table> -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
</div>



<?php
include("include/footer.php");
?>



<script>
    <?php
    $msg = $_GET['msg'];
    if ($msg != '') {
    ?>
        swal("", "<?php echo $msg; ?>", "success");
    <?php
    }
    ?>
</script>

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