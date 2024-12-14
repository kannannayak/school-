<?php
include('include/conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['state_id'])) {
    $id = $_POST['state_id'];
    $sql = "SELECT * FROM district WHERE state_id = '$id'";
    $result = mysqli_query($conn, $sql);
    $out = '<option value="">Select District</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        $out .= '<option value="' . $row["district_id"] . '">' . $row["district_name"] . '</option>';
    }
    echo $out;
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 1200px;
            margin: 30px auto;
            background-color: #E6F4FB;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: bold;
        }
        .btn {
            background: linear-gradient(to bottom, #102B6E, #0191D6);
            color: #fff;
        }
        .register {
            color: #102B6E;
        }
        @media (min-width: 768px) {
            .col-md-4 {
                flex: 0 0 33.333333%;
                max-width: 33.333333%;
            }
        }
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                   <h3 class="text-center mb-4 register"><b>Registration</b></h3>
            </div>
            <div class="col-md-2">
               <a href="login.php" class="btn">Back</a>

            </div>
           
        </div>
      
        
        <form action="action/post_register.php" method="post" enctype="multipart/form-data">
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="trainer_name" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="mobileNo" class="form-label">Mobile No.</label>
                        <input type="number" class="form-control" name="trainer_mobile" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="trainer_email" required>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" name="trainer_dob" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="schoolName" class="form-label">Assigned School Name/Territory</label>
                        <select name="trainer_school" class="form-control" required>
                            <option value="">Select School</option>
                            <?php 
                            $result = mysqli_query($conn, "SELECT * FROM school_list");
                            while ($school_row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $school_row['school_id'] . "'>" . $school_row['school_name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="location" class="form-label">Address</label>
                        <input type="text" class="form-control" name="trainer_address" required>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="state" class="form-label">State</label>
                        <select name="trainer_state" class="form-control" id="trainer_state" required>
                            <option value="">Select State</option>
                            <?php 
                            $result = mysqli_query($conn, "SELECT * FROM state");
                            while ($state_row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $state_row['state_id'] . "'>" . $state_row['state_name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="district">
                        <label for="district" class="form-label">District</label>
                        <select name="district" id="district_select" class="form-control" required>
                            <option value="">Select District</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="pinCode" class="form-label">PinCode</label>
                        <input type="number" class="form-control" name="pincode" required>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="proof" class="form-label">ID Proof</label>
                        <input type="file" class="form-control" name="trainer_id_proof" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="profile" class="form-label">Profile Photo</label>
                        <input type="file" class="form-control" name="trainer_img" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="tlog_pass" required>
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <button type="submit" name="submit" class="btn">Submit</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#trainer_state').on('change', function() {
                var stateID = $(this).val();
                if (stateID) {
                    $.ajax({
                        type: 'POST',
                        url: 'register.php',
                        data: {state_id: stateID},
                        success: function(data) {
                            $('#district_select').html(data);
                        }
                    });
                } else {
                    $('#district_select').html('<option value="">Select District</option>');
                }
            });
        });
    </script>
</body>
</html>
