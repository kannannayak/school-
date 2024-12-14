<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
    
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.card{
    max-width: 1300px;
    margin: 50px auto;
    margin-top:150px;
    background-color:#E6F4FB ;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

.form-label {
    font-weight: bold;
}
.form-group {
            margin-bottom: 20px;
        }


.btn{
    background: linear-gradient(to bottom, #102B6E, #0191D6);
    color:#fff;
}



@media (min-width: 768px) {
    .col-md-4 {
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }
}

.center-image {
    display: block;
    margin: 0 auto;
}
.otp{
    color:#102B6E;
}
             /* background: linear-gradient(to bottom, #102B6E, #0191D6);
            -webkit-background-clip: text; 
            background-clip: text;
            color: transparent;
            font-weight:bold;  */



</style>
<?php    
include("include/conn.php");
session_start();
if(isset($_POST["get_otp"])){
        $email = $_POST["email"];
        // $password = $_POST["password"];

        // print_r($email);
        // exit();

        $check_query = mysqli_query($conn, "SELECT * FROM  `admin` where admin_email ='$email'");
        $rowCount = mysqli_num_rows($check_query);

        if(!empty($email)){
            if($rowCount > 0){
                $otp = rand(100000,999999);
                $_SESSION['otp'] = $otp;
                $_SESSION['mail'] = $email;
             
               
                require "Mail/phpmailer/PHPMailerAutoload.php";
                $mail = new PHPMailer;

                $mail->isSMTP();
                $mail->Host='smtp.gmail.com';
                $mail->Port=587;
                $mail->SMTPAuth=true;
                $mail->SMTPSecure='tls';

                $mail->Username='vicky964242@gmail.com';
                $mail->Password='imfxosyiuhtynzff';

                $mail->setFrom('vicky964242@gmail.com', 'OTP Verification');
                $mail->addAddress($_POST["email"]);

                $mail->isHTML(true);
                $mail->Subject="Your verify code";
                $mail->Body="<p>Dear user, </p> <h3>Your verify OTP code is $otp <br></h3>
                <br><br>
                <p>With regrads,</p>
                <b>Mithra Sports</b>
                ";
                // $mail->send();
                        if(!$mail->send()){
                            ?>
                                <script>
                                    alert("<?php echo "OTP send Failed, Invalid Email "?>");
                                </script>
                                
                            <?php
                        }else{
                            ?>
                            
                            <script>
                                alert("<?php echo "OTP sent to " . $email ?>");
                                window.location.replace('otp.php');
                            </script>
                            <?php
                        }
             
            }else{
                ?>

                <script>
                    alert("This Mail Not Register Enter Valid Mail ID");
                </script>
                <?php
                // $password_hash = password_hash($password, PASSWORD_BCRYPT);

                // $result = mysqli_query($con, "INSERT INTO login (email, password, status) VALUES ('$email', '$password_hash', 0)");
    
                
                   
                }
            }
        }
     ?>
<body>

<!-- <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card">
                <div class="card-body">
                    <img class="center-image" src="images/mithraa.png" alt="MITHRAA Header Image" height="60px" width="200px">
                    <p class="text-center"> Enter your Email ID to change password</p>
                    <form>
                    <div class="form-group">
                          <label for="name">Enter the Email ID</label>
                          <input type="text" class="form-control" id="emailId" placeholder="Enter your emailid" required>
                    </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Get OTP</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div> -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
               
                <h3 class="text-center  otp"><b>Forgot Password</b></h3>
                    <p class="text-center">Enter your Email ID to change password</p>
                    <Br>
                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="emailId">Enter Email ID</label>
                            <input type="email" class="form-control" id="emailId" name="email"  placeholder="Enter your email id" required>
                        </div>
                        <div class="text-center">
                        
                        <input class="btn btn-primary" type="submit" value="Get OTP" name="get_otp"></input>

                        </div>
                            
                           
                        
                    </form>
                
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap JS (Optional, only if you need JS functionalities) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
