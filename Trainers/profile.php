<?php
// session_start();
include("include/header.php");

include("include/conn.php");
// if (!isset($_SESSION['trainer_id'])) {
//     header("Location: login.php");
//     exit;
// }

// ?>

<style>
    body {
        background: #E6F4FB !important;
    }

    .profile {
        color: #102B6E !important;
        margin-top: 30px;
        margin-left: 15px; /* Adjusted margin for responsiveness */
    }

    .container {
        max-width: 1200px;
        background: #C7E2EF !important;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        z-index: 5;
    }

    .card {
        background: #fff;
        margin-top: 10px;
        padding: 10px; /* Added padding for better spacing */
    }

    p {
        margin-top: 10px; /* Adjusted margin for better spacing */
        margin-left: 10px;
    }

    .profile-image {
        border-radius: 50%; 
        overflow: hidden; 
        width: 150px; 
        height: 150px;
        margin-left:30px;
    }
    .edit{
        margin-top: 120px;
        margin-left: -14px;
        position: absolute;
    }
</style>

<h4 class="profile">Profile</h4>
<div class="container">
    <div class="row">
        <div class="col-md-3">
        
         <img src="<?php echo $_SESSION['trainer_img']; ?>" class="profile-image" alt="Profile Image"> 

         <a href="edit_trainer.php"><i class="fas fa-edit edit"></i></a>
            <br>
            <br>
            <p style="margin-left:30px;"><?php echo $_SESSION['trainer_name']; ?></p>
            
        </div>


       
        <div class="col-md-9">
            <div class="card">
                <p><b>Trainer ID:</b> <?php echo $_SESSION['tlog_id'] ?></p>
            </div>
            



           

            <div class="card">
    <p><b> Trainer's Age:</b>
        <?php 
        // Check if trainer's date of birth is set in session
        if(isset($_SESSION['trainer_dob'])) {
            // Calculate age based on date of birth
            $dob = $_SESSION['trainer_dob'];
            $dob_timestamp = strtotime($dob);
            $current_date = time();
            $age = date("Y", $current_date) - date("Y", $dob_timestamp);
            
            // Adjust age if birthday hasn't occurred yet this year
            if(date("md", $current_date) < date("md", $dob_timestamp)) {
                $age--;
            }
            
            // Output the age
            echo $age;
        } else {
            // Handle case where trainer's date of birth is not set in session
            echo "Date of birth not set.";
        }
        ?>
    </p>
</div>


<?php


$id = $_SESSION['tlog_id'];

$sql = "SELECT COUNT(c.user_id) AS num_of_stud, b.school_name FROM `trainer` AS a JOIN school_list AS b ON a.school_id = b.school_id JOIN users AS c ON b.school_id = c.school_id WHERE a.tlog_id = ?

";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$trainer = mysqli_fetch_array($result);
    $school_name = $trainer['school_name'];
    $num_students = $trainer['num_of_stud'];
    
$sql_today = "SELECT COUNT(c.user_id) AS num_of_stud_today 
              FROM trainer AS a 
              JOIN school_list AS b ON a.school_id = b.school_id 
              JOIN users AS c ON b.school_id = c.school_id 
              WHERE a.tlog_id = ? AND DATE(c.user_created) = CURDATE()";

$stmt_today = mysqli_prepare($conn, $sql_today);
mysqli_stmt_bind_param($stmt_today, "s", $id);
mysqli_stmt_execute($stmt_today);
$result_today = mysqli_stmt_get_result($stmt_today);

$trainer_today = mysqli_fetch_array($result_today);
$num_students_today = $trainer_today['num_of_stud_today'];
?>



<div class="card">
    <p><b>Territory/school Name:</b> <?= $school_name ?></p>
</div>

<div class="card">
    <p><b>No. of student:</b> <?= $num_students ?></p>
</div>

<div class="row">
    <div class="col-md-6">
      <div class="card">
      <p><b>Today students Registered:</b> <?=  $num_students_today ?></p>
</div>

    </div>
     <div class="col-md-6">
       <div class="card">
    <p><b>Total students Registered:</b> <?= $num_students ?></p>
</div>

    </div>
</div>
<?php
mysqli_stmt_close($stmt);
?>


    </div>
</div>

<?php
include("include/footer.php");
?>
