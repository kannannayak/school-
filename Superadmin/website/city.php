<?php
ini_set('error_reporting', 0);
ini_set('display_errors', 0);

include("include/header.php");
include("include/config.php");

$id = $_GET['id'];

$sql = "SELECT * FROM `city` WHERE `city_id` = '$id'";
$result = mysqli_query($con, $sql);


if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $city_id = $row['city_id'];
    $city_name = $row['city_name'];
}

?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.7/css/dataTables.bootstrap5.min.css">


<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">


<!-- begin MAIN PAGE CONTENT -->
<div class="container-fluid pt-4 px-4 ">
    <div class="row bg-light rounded mx-0">

        <!-- begin PAGE TITLE ROW -->
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title">
                    <h3 class="text-center mt-3 mb-5">City List</h3>

                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-lg-6" id="add_my_category">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><?php echo ($id == '') ? 'Add New City' : 'Edit City'; ?></h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="actions/city_add_edit.php" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="var_category" class="form-label">City Name</label>
                                <input required type="text" name="city_name" class="form-control" id="var_category" placeholder="Enter City Name" value="<?php echo $city_name; ?>">
                                <input type="hidden" name="city_id" value="<?php echo $city_id; ?>">
                            </div>
                            <div class="text-end">
                                <button type="submit" name="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6" id="activate_brand_list">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">City List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="city-table" class="table table-striped table-bordered table-hover city">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>City Name</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM `city` ORDER BY city_id";
                                    $result = mysqli_query($con, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        $count = 1;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $city_id = $row['city_id'];
                                            $city_name = $row['city_name'];
                                    ?>
                                            <tr>
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $city_name; ?></td>
                                                <td class="text-center">
                                                    <a href="city.php?id=<?php echo $city_id; ?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                                    <a href="actions/delete_city.php?id=<?php echo $city_id; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                    <!-- <button class="btn btn-danger btn-sm delete-city" data-city-id="<?php echo $city_id; ?>"><i class="fa fa-trash"></i></button> -->
                                                </td>

                                            </tr>
                                    <?php
                                            $count++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>



                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <!-- end MAIN PAGE ROW -->

    </div>
    <!-- /.page-content -->
</div>
<!-- /#page-wrapper -->
<!-- end MAIN PAGE CONTENT -->

<?php include("include/footer.php"); ?>
<!-- DataTables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.7/js/dataTables.bootstrap5.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<script>
    $(document).ready(function() {
        $('#city-table').DataTable({
            // Custom options here (if needed)
        });
    });
    
</script>

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