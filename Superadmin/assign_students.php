<?php
include("include/header.php");
include("include/conn.php");

error_reporting(0);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_GET['ass_id'])){

    $ass_id = $_GET['ass_id'];
}

// Fetch coordinators
$sql1 = "SELECT trainer_id, trainer_name FROM trainer WHERE trainer_status = '1'";
$result1 = $conn->query($sql1);

$coordinators = array();
if ($result1->num_rows > 0) {
    while($row = $result1->fetch_assoc()) {
        $coordinators[$row["trainer_id"]] = $row["trainer_name"];
    }
}

// Fetch drivers
$sql2 = "SELECT user_id, user_name FROM users";
$result2 = $conn->query($sql2);

$drivers = array();
if ($result2->num_rows > 0) {
    while($row = $result2->fetch_assoc()) {
        $driver_id = $row['user_id'];
        $driver_name = $row['user_name'];
        $drivers[$row["user_id"]] = $row["user_name"];
    }
}



$sql5 = "SELECT DISTINCT student_id FROM assign_students";
$result5 = $conn->query($sql5);

$assignedstudents = array();


if ($result5->num_rows > 0) {
    while($row = $result5->fetch_assoc()) {
        $assignedstudents = array_merge($assignedstudents, explode(',', $row["student_id"]));
        
    }
}


$students = array_diff_key($students, array_flip($assignedstudents));



if (!empty($ass_id) && isset($ass_id)) {
    $sqlcoord = "SELECT `trainer_id` FROM `assign_students` where `ass_id` = $ass_id";
    $resultcoord = $conn->query($sqlcoord);

    $coord_namef = mysqli_fetch_assoc($resultcoord);


    $trainer_id = $coord_namef['trainer_id'];
}


?>

<html lang="en">
<head>
    <title></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    
</head>
<body>
<div id="page-wrapper"  style="min-height:142vh;">




<div class="col-lg-12"  style="min-height:142vh;">
    
            <div class="portlet portlet-default">
                <div class="portlet-heading">
                    <div class="portlet-title">
                     <h4><?php if(!empty($ass_id) && isset($ass_id)){
                        echo 'Edit Assign Trainer';
                     }else{echo'Assign Trainer';} ?></h4>
                    </div>
                    <div class="portlet-widgets">
                        <a data-toggle="collapse" data-parent="#accordion" href="#inputSizing"><i class="fa fa-chevron-down"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="inputSizing" class="panel-collapse collapse in">
                    <div class="portlet-body">
                        <div class="row" id="admin_users">
                            <form method="post" action="action/assg_stud.php">
                                
                                <div class="row" style = "margin : 7px">
                                <div class="col-md-6">
                                
                                <label for="trainer">Choose a Trainer:</label><br>
                                <select id="trainer" name="trainer"  class = "form-control">
                                    <?php
                                    if (!empty($ass_id) && isset($ass_id)) {
                                        $csql1 = "SELECT trainer_id, trainer_name FROM trainer where trainer_id = $trainer_id";
                                        $cresult1 = $conn->query($csql1);


                                        if ($cresult1->num_rows > 0) {
                                            while ($crow = $cresult1->fetch_assoc()) {
                                                echo "<option value=" . $crow['trainer_id'] . ">" . $crow['trainer_name'] . "</option>";
                                            }
                                        }
                                    } else {
                                        echo "<option value='' selected>Select Trainer</option>";
                                    }
                                    foreach ($trainers as $id => $trainer) {
                                        echo "<option value='$id'>$trainer</option>";
                                    }
                                    ?>
                                </select><br>
                                <input type="hidden" name="ass_id" value="<?=$ass_id?>">
                            </div>

                            
                              <div class="col-md-6">
                                    <label for="student">Choose Students:</label><br>
                                    <select class="student form-control" name="student[]" multiple>
                                        <?php
                                        if (!empty($ass_id) && isset($ass_id)) {
                                            $tsql = "SELECT student_id FROM `assign_students` WHERE `ass_id` = '$ass_id'";
                                            $tres = mysqli_query($conn, $tsql);

                                            while ($row = mysqli_fetch_assoc($tres)) {
                                                $user_ids = explode(',', $row['user_id']);

                                                foreach ($user_ids as $key => $user_id) {
                                                    $studentsql = "SELECT user_id, user_name FROM `users` WHERE `user_id` = $user_id";
                                                    $studentes = mysqli_query($conn, $studentsql);

                                                    while ($studentrow = mysqli_fetch_assoc($studentes)) {
                                                        echo '<option value="' . $studentrow['user_id'] . '" selected>' . $studentrow['user_name'] . '</option>';
                                                    }
                                                }
                                            }
                                        }
                                        $sql2 = "SELECT user_id, user_name FROM users";
                                        $result2 = $conn->query($sql2);

                                        if ($result2->num_rows > 0) {
                                            while ($row = $result2->fetch_assoc()) {
                                                $user_id = $row['user_id'];
                                                $user_name = $row['user_name'];
                                                if (!in_array($user_id, $assignedstudents)) {
                                                    echo "<option value='$user_id'>$user_name</option>";
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                           
                            
                                </div>

                                
                               
                                   
                                <br><br>
                               
                               
                                <div class="col-md-6">
                                    <input type="submit" name="submit" id="brand_btn" class="btn btn-success mt-5" value="Submit">
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>













        <script type="text/javascript">
    $(document).ready(function() {
        $('.student').select2();
       
    });
</script>


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



</body>
</html>

<?php
include("include/footer.php");
?>