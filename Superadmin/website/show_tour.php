


<?php
include('include/header.php');
include('include/config.php');

// Check if edit parameter is set and is numeric
if(isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $id = $_GET['edit'];
    
    // Prepare and execute the SQL query using prepared statements
    $stmt = $con->prepare("SELECT * FROM registerform 
                        JOIN tournament ON registerform.tournament=tournament.tourn_id
                        WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    
    // Check if any row is returned
    if($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $id = htmlspecialchars($row['id']);
        $name = htmlspecialchars($row['name']);
        $email = htmlspecialchars($row['email']);
        $gender = htmlspecialchars($row['gender']);
        $age = htmlspecialchars($row['age']);
        $tournament = htmlspecialchars($row['tourn_name']);
        $grade = htmlspecialchars($row['grade']);
        $phone = htmlspecialchars($row['phone']);
        $schoolname = htmlspecialchars($row['schoolname']);
        $address = htmlspecialchars($row['address']);
        $district = htmlspecialchars($row['district']);
        $pincode = htmlspecialchars($row['pincode']);
        
        
    
    } else {
        echo "No record found.";
        exit; // Stop execution if no record found
    }
} else {
    echo "Invalid request.";
    exit; // Stop execution if edit parameter is missing or invalid
}
?>

<script src="https://cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded mx-0">
        <div class="col-md-12">
            <div class="row my-2">
                <div class="col-md-10">
                    <h3>Show registration Details</h3>
                </div>
                <div class="col-md-2">
                    <a href="register_tour" class="btn btn-primary">Back</a>
                </div>
            </div>
            <form action="" method="post" enctype="multipart/form-data" id="productForm">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($name) ?>" id="name">
                            <span class="error" style="color:red;" id="name_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($email) ?>" id="email" required>
                            <span class="error" style="color:red;" id="email_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <input type="text" name="gender" class="form-control" value="<?= htmlspecialchars($gender) ?>" id="gender" required>
                            <span class="error" style="color:red;" id="gender_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="number" name="age" class="form-control" value="<?= htmlspecialchars($age) ?>" id="age" required>
                            <span class="error" style="color:red;" id="age_error"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                       
                        <div class="form-group">
                            <label for="tournament">Tournament</label>
                            <input type="text" name="tournament" class="form-control" value="<?= htmlspecialchars($tournament) ?>" id="tournament" required>
                            <span class="error" style="color:red;" id="tournament_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="grade">Year</label>
                            <input type="text" name="grade" class="form-control" value="<?= htmlspecialchars($grade) ?>" id="grade">
                            <span class="error" style="color:red;" id="grade_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" name="phone" class="form-control" value="<?= htmlspecialchars($phone) ?>" id="phone">
                            <span class="error" style="color:red;" id="phone_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="schoolname">School Name</label>
                            <input type="text" name="schoolname" class="form-control" value="<?= htmlspecialchars($schoolname) ?>" id="schoolname" required>
                            <span class="error" style="color:red;" id="school_error"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                       
                        
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" class="form-control" value="<?= htmlspecialchars($address) ?>" id="address" required>
                            <span class="error" style="color:red;" id="address_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="district">District</label>
                            <input type="text" name="district" class="form-control" value="<?= htmlspecialchars($district) ?>" id="district" required>
                            <span class="error" style="color:red;" id="district_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="pincode">Pin Code</label>
                            <input type="text" name="pincode" class="form-control" value="<?= htmlspecialchars($pincode) ?>" id="pincode" required>
                            <span class="error" style="color:red;" id="pincode_error"></span>
                        </div>
                    </div>


                    
                </div>
                <!-- <button class="btn btn-primary" type="submit" name="update_profile" value="submit">Submit</button> -->
            </form>
        </div>
    </div>
</div>

<!-- Blank End -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    CKEDITOR.replace('pro_desc');
</script>
<?php include('include/footer.php'); ?> 
