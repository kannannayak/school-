
 <?php
// include("include/header.php");
?>
 <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" /> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Mithraa sports</title>
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<style>
   @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

<style>
        .cardcolor {
            max-width: 1000px;
            margin: 50px auto;
            background:#E6F4FB !important;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
            background:#fff;
        }

        .form-label {
            font-weight: bold;
        }
        .btn{
            background: linear-gradient( to bottom, #102B6E, #0191D6);
            color:#fff;
        }
       .login {
             background: linear-gradient(to bottom, #102B6E, #0191D6);
            -webkit-background-clip: text; 
            background-clip: text;
            color: transparent;
            font-weight:bold; 
}

        @media (min-width: 768px) {
            .col-md-4 {
                flex: 0 0 33.333333%;
                max-width: 33.333333%;
            }
        }
        .center-image {
             display: block; /* Ensure the image is treated as a block element */
            margin: 0 auto; /* Center the image horizontally */
}
</style>
<div class="container mt-5">
  <div class="row justify-content-center">

    <div class="col-md-6">
      <div class="card cardcolor" style="background:#E6F4FB ;">

        <div class="card-body">
          <!-- <h3 class="card-title login text-center">MITHRAA</h3> -->
          <!-- <img class="center-image" src="images\mithraa.png" alt="MITHRAA Header Image" height="60px" width="200px"> -->
          <img class="center-image" src="./images/mask_group.png" alt="MITHRAA Header Image" height="80px" width="300px">

          <form  method="post">
            <div class="mb-3">
              <label for="trainerId" class="form-label">Trainer ID</label>
              <input type="text" class="form-control" id="tlog_id" name="tlog_id"  placeholder="Enter trainer Id">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="tlog_pass" name="tlog_pass" placeholder="Password">
            </div>
            <div class="text-center">
              <button type="submit"  class="btn btn-primary">submit</button>  <p style="text-align:center" ><a href="forgotpass.php">forgot Password</a></p>
            </div>
            <br>
            <!-- <div>
            <p style="text-align:center" ><a href="forgotpass.php">forgot Password</a></p>
            </div> -->
            <br>
            <div>
               <p style="text-align:center">Don't have account?   <a href="register.php">Register</a></p>
            </div>
          </form>

        </div>

      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS (Optional, only if you need JS functionalities) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<?php
    include('include/conn.php');
    session_start();

    if (isset($_POST['tlog_id']) && isset($_POST['tlog_pass'])) {
        $tlog_id = $_POST['tlog_id'];
        $tlog_pass = $_POST['tlog_pass'];
       
  // Sanitize inputs to prevent SQL injection
  $tlog_id = mysqli_real_escape_string($conn, $tlog_id);
  $tlog_pass = mysqli_real_escape_string($conn, $tlog_pass);


        // Query the database to find a user with matching credentials
        $sql = "SELECT * FROM `trainer`
         WHERE `tlog_id`='$tlog_id' AND `tlog_pass`='$tlog_pass' AND `trainer_status`= 1";
        $result = mysqli_query($conn, $sql);

        // If a matching user is found, set session variables and redirect to index page
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['trainer_name'] = $user['trainer_name'];
            $_SESSION['trainer_id'] = $user['trainer_id'];
            $_SESSION['tlog_id'] = $user['tlog_id'];
            $_SESSION['trainer_school'] = $user['school_id'];
            $_SESSION['trainer_img'] = $user['trainer_img'];
            $_SESSION['trainer_dob'] = $user['trainer_dob'];
            $_SESSION['trainer_id'] = $user['trainer_id'];

            // Redirect to index page or any other desired page
            echo "<script> 
            Swal.fire({
            icon: 'success',
            title: 'Login successful!',
            showConfirmButton: false,
            timer: 1000
        }).then(function() {
            window.location.href = 'profile.php';
        });
      </script>";
            exit();
        } else {
            $error_message = "Invalid Email or Password";
        
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '$error_message',
                confirmButtonText: 'OK'
            }).then(function() {
                // You can optionally redirect here or take any other action
            });
            </script>";
        }
        
    }

    ?>
