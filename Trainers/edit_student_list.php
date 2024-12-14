<?php
include("include/header.php");
include("include/conn.php");


if(isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $id = $_GET['edit'];
    
    // Prepare and execute the SQL query using prepared statements
  $stmt = $conn->prepare("SELECT * FROM users 
                        JOIN school_list ON users.school_id=school_list.school_id
                         JOIN state ON users.state=state.state_id
                        JOIN trainer ON users.school_id = trainer.school_id 
                        JOIN gender ON users.gender = gender.gender_id 
                        WHERE user_id=?"); 
$stmt->bind_param("i", $id); 

    $stmt->execute();
    $res = $stmt->get_result();
    
    // Check if any row is returned
    if($res->num_rows > 0) {
         $row = $res->fetch_assoc();
        $id = htmlspecialchars($row['user_id']??'');
        $user_name = htmlspecialchars($row['user_name']??'');
        $user_uniq_id = htmlspecialchars($row['user_uniq_id']??'');
        $user_age = htmlspecialchars($row['user_dob']??'');
        $gender_name = htmlspecialchars($row['gender_name']??'');
        $parent_name = htmlspecialchars($row['parent_name']??'');
        $user_email = htmlspecialchars($row['user_email']??'');
         $user_mobile = htmlspecialchars($row['user_mobile']??'');
        $user_address = htmlspecialchars($row['user_address'] ??'');
        $district = htmlspecialchars($row['district'] ??'');
        $pincode = htmlspecialchars($row['pincode'] ??'');
        $school_name = htmlspecialchars($row['school_name']??'');
        $state = htmlspecialchars($row['state'] ?? '');
        $id_proof = htmlspecialchars($row['id_proof']??'');
        $profile_pic = htmlspecialchars($row['profile_pic']??'');
        $confirm_password = htmlspecialchars($row['confirm_password']?? '');
        $ulog_id = htmlspecialchars($row['ulog_id'] ?? ''); 

    } else {
        echo "No record found.";
        exit; 
    }
} else {
    echo "Invalid request.";
 
}
?>




<style>
 .container {
            /*max-width: 1200px;*/
            /*margin: 30px auto;*/
            background-color:#E6F4FB ;
            /*padding: 30px;*/
            /*border-radius: 10px;*/
            /*box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);*/

        }
     body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .form-group {
            margin-bottom: 5px;
        }

        .form-label {
            font-weight: bold;
        }
        .btn{
            background: linear-gradient( to bottom, #102B6E, #0191D6);
            color:#fff;
        }
       .register {
             /* background: linear-gradient(to bottom, #102B6E, #0191D6);
            -webkit-background-clip: text; 
            background-clip: text;
            color: transparent;
            font-weight:bold;  */
            color:#102B6E;
}
</style>




 <div class="container">
<h3 class="text-center mb-4 register"><b>Edit Student Details</b></h3>
    <form  action="action/edit_student_details.php" method="post" enctype="multipart/form-data">
        <div class="row mb-4 mb-4">
       
            <div class="col-md-4">
                <div class="form-group">
                    <label for="" class="form-label">Name</label>
                    <input type="text" class="form-control"  name="user_name" value="<?= $user_name ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="" class="form-label">Parent Name</label>
                    <input type="text" class="form-control" name="parent_name" value="<?= $parent_name ?>">
                </div>
            </div>
         
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="" class="form-label">Email</label>
                    <input type="email" class="form-control"  name="user_email" value="<?= $user_email ?>">
                </div>
            </div>
        </div>
        <div class="row mb-4 mb-4">
        <div class="col-md-4">
                <div class="form-group">
                    <label for="" class="form-label">Mobile Number</label>
                    <input type="text" class="form-control"  name="user_mobile"  value="<?= $user_mobile ?>">
                </div>
            </div>
           
            <div class="col-md-4">
                <div class="form-group">
                        <label>School name</label>
    <select name="school_id" class="form-control" >
    <?php
        
        $result = mysqli_query($conn, "SELECT * FROM school_list");
                while ($state_row = mysqli_fetch_array($result)) {
                    echo "<option value='" . $state_row['school_id'] . "'";
                    if ($state_row['school_id'] == $row['school_id']) {
                        echo " selected";
                    }
                    echo ">" . $state_row['school_name'] . "</option>";
                }
        ?>
                       </select>
</div>
            </div>
            
            
            
            
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="" class="form-label">Address</label>
                    <input type="text" class="form-control"  name="user_address"  value="<?= $user_address ?>">
                </div>
            </div>
          
          
        </div>
        <div class="row mb-4 mb-4">
        <div class="col-md-4">
                <div class="form-group">
                    <label for="" class="form-label">District</label>
                    <input type="text" class="form-control"  name="district"  value="<?= $district ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                        <label>State</label>
    <select name="state_id" class="form-control" >
    <?php
        
        $result = mysqli_query($conn, "SELECT * FROM state");
                while ($state_row = mysqli_fetch_array($result)) {
                    echo "<option value='" . $state_row['state_id'] . "'";
                    if ($state_row['state_id'] == $row['state_id']) {
                        echo " selected";
                    }
                    echo ">" . $state_row['state_name'] . "</option>";
                }
        ?>
                       </select>
</div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="" class="form-label">PinCode</label>
                    <input type="number" class="form-control"  name="pincode"  value="<?=  $pincode ?>">
                </div>
            </div>
        </div>
        <div class="row mb-4 mb-4">
        <div class="col-md-4">
                <div class="form-group">
                    <label for="" class="form-label">ID Proof</label>
                    <input type="file" class="form-control" name="id_proof"  value="<?= $id_proof ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="" class="form-label">profile photo</label>
                    <input type="file" class="form-control"  name="profile_pic"  value="<?= $profile_pic  ?>">
                </div>
            </div>
            <div class="col-md-4">
            <div class="form-group">
                    <label for="proof" class="form-label">Password</label>
                    <input type="text" class="form-control"  name="confirm_password" value="<?= $confirm_password ?>">
                </div>
                </div>
            
        </div>
        <input type="hidden" name="id" value="<?= $id ?>"> 
        <div class="form-group text-center">
            <button type="submit" value="submit" name="submit" class="btn">submit</button>
        </div>
    </form>

</div>








 <?php 
include("include/footer.php");
?>