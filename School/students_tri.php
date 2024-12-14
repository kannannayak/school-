<?php
include("include/header.php");
include("include/conn.php");

$trainerl_id = isset($_GET['id']) ? (int)$_GET['id'] : null; 

?>

<div id="page-wrapper" style="min-height:142vh;">
    <div class="page-content">
        <!-- begin PAGE TITLE ROW -->
        <div class="row">
            <div class="col-lg-12">
                <div class="page-title">
                    <h1>Students List</h1>
                </div>
                <div class="row">
                    <div class="col-lg-12" style="margin-bottom:10px;">
                        <div class="pull-right">
                            <!-- <a href="download_profiles.php" class="btn btn-primary" >Download</a> -->
                        </div>
                    </div>
                </div>

                <table id="data_table" class="display dataTable table table-striped table-bordered table-hover table-green">
                    <thead>
                        <tr>
                            <th scope="col">S.No</th>
                            <th scope="col">Name</th>
                            <!--<th scope="col">Parent Name</th>-->
                            <th scope="col">Uniq id</th>
                             <th scope="col">Trainer Name</th>
                            <th scope="col">School</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Age</th>
                            
                            <!--<th scope="col">District</th>-->
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $sql = "SELECT us.*, gen.gender_name,sch.school_name,tri.trainer_name 
                        FROM users AS us
                        JOIN school_list AS sch ON us.school_id  = sch.school_id
                        JOIN gender AS gen ON us.gender = gen.gender_id
                        JOIN trainer AS tri ON us.trainer_id = tri.trainer_id
                        WHERE tri.trainer_id = $trainerl_id
                        ORDER BY user_id DESC";

                        $res = mysqli_query($conn, $sql);

                        if ($res) {
                            $count = 0;
                            while ($row = mysqli_fetch_assoc($res)) {
                                $count++;
                                // rest of the code...

                                $id = $row['user_id'];
                                $user_uniq_id = $row['user_uniq_id'];
                                $user_name = $row['user_name'];
                                $parent_name = $row['parent_name'];
                                $user_email = $row['user_email'];
                                $user_mobile = $row['user_mobile'];
                                $user_age = $row['age_in_months'];
                                $gender_name = $row['gender_name'];
                                $school_name = $row['school_name'];
                                $district = $row['district'];
                                  $trainer_name = $row['trainer_name'];
                              

                        ?>

                                <tr>
                                    <td><?= $count ?></td>
                                    <td><?= $user_name ?></td>
                                    <!--<td><?= $parent_name ?></td>-->
                                    <td><?= $user_uniq_id ?></td>
                                     <td><?= $trainer_name ?></td>
                                    <td><?= $school_name ?></td>
                                    <td><?= $user_email ?></td>
                                    <td><?= $user_mobile ?></td>
                                    <td><?= $gender_name ?></td>
                                    <td><?= $user_age ?></td>
                                    
                                    <!--<td><?= $district ?></td>-->
                                    <td  style="display: flex; justify-content: space-evenly;">
                                       <a href="students_view.php?id=<?= $id ?>">
                                            <button class="btn btn-primary">  <i class="fa-solid fa-eye"></i>   </button>
                                        </a>
                                          <a href="student_edit.php?id=<?= $id ?>">
                                            <button class="btn btn-warning"> <i class="fa-solid fa-pen-to-square"></i></button>
                                        </a>
                                           <a href="action/student_delete.php?id=<?= $id ?>">
                                            <button class="btn btn-danger">  <i class="fa fa-trash-o"></i> </button>
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
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#data_table').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'csv',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> CSV ',
                    title: 'User Report',
                    titleAttr: 'DownLoad as CSV File',
                },
                {
                    extend: 'excel',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> Excel',
                    title: 'User Report',
                    titleAttr: 'Download as Excel File',
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> PDF',
                    title: 'Driver Report',
                    titleAttr: 'Download as PDF File',
                },
                {
                    extend: 'print',
                    className: 'btn btn-primary',
                    text: '<i class="fa-solid fa-download"></i> Print',
                    title: 'Driver Report',
                    titleAttr: 'Print User reports',
                },
            ]
        });

       
    })

       
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
