<?php
include("include/conn.php");
require 'PHPMailer/PHPMailerAutoload.php'; 
// require 'PHPMailer/PHPMailer.php'; 
// Adjust path as necessary
session_start();



if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check credentials in admin table
    $sql2 = "SELECT * FROM `admin` WHERE `admin_email` = ? AND `admin_pass` = ?";
    $stmt = $conn->prepare($sql2);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result2 = $stmt->get_result();

    if ($result2->num_rows == 1) {
        $vendor = $result2->fetch_assoc();
        $_SESSION['admin_name'] = $vendor['admin_name'];
        $_SESSION['admin_email'] = $email;

        // Generate and store OTP
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;

        // Update the OTP in the admin table
        $sql_update_otp = "UPDATE `admin` SET `otp_pass` = ? WHERE `admin_email` = ?";
        $stmt_update = $conn->prepare($sql_update_otp);
        $stmt_update->bind_param("is", $otp, $email);
        $stmt_update->execute();

        // Send OTP via email
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Username = 'dhandapanisekar14@gmail.com'; // Update with your email
        $mail->Password = 'vifukxoaybvnamza'; // Update with your app-specific password

        $mail->setFrom('dhandapanisekar14@gmail.com', 'OTP Verification'); // Update as needed
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = "Your OTP Code";
        $mail->Body = "<p>Dear admin,</p><h3>Your OTP code is $otp</h3><p>Regards,</p><b>Your Company</b>";

        if ($mail->send()) {
            header("Location: verify_otp.php");
            exit;
        } else {
            echo "<div class='alert alert-danger'>Failed to send OTP. Please try again.</div>";
        }
    } else {
        $error_message = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin Login</title>
    <link href="css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic' rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel="stylesheet" type="text/css">
    <link href="icons/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/flex-admin.css" rel="stylesheet">
    <link href="css/plugins.css" rel="stylesheet">
    <link href="css/demo.css" rel="stylesheet">


    <style>
        /* Alert container */
        .alert-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            display: none;
            z-index: 1;
        }

        /* Alert box */
        .alert-box {
            position: relative;
            margin: 10% auto;
            width: 80%;
            max-width: 600px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        /* Alert message */
        .alert-message {
            display: block;
            padding: 20px;
            font-size: 1.2rem;
            text-align: center;
        }

        /* Alert close button */
        .alert-close {
            position: absolute;
            top: 0;
            right: 0;
            padding: 10px 15px;
            background-color: #f44336;
            color: #fff;
            font-size: 1.2rem;
            border: none;
            border-radius: 0 3px 0 0;
            cursor: pointer;
        }

        .login {
            background-color: white;
        }

        .remcolr {
            color: black;
            margin-left: -250px;
        }

        .btncolor {
            background: linear-gradient(to bottom, #102B6E, #0191D6);
            color: white;
        }

        .satimgg {
            margin-top: 100px;
        }
        .bgbox{
            background-color: #E5F4FB;
            width: 500px;
            height: 600px;
            border-radius: 3px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    padding: 10px 50px 30px 50px;
    text-align: center;
    align-items: center;
   

        }
        #items{
            align-items: center;
    display: flex;
    justify-content: center;
        }
    </style>
</head>
<body class="login">
    <div class="container">
        <div class="row ">
            
            <!--<div class="bgbox">-->
            <!--    <div class="text-center">-->
            <!--        <img src="img/logomithra2.png" width="350" alt="" class="img-fluid">-->
            <!--    </div>-->
            <!--    <form method="POST" action="" accept-charset="UTF-8">-->
            <!--        <fieldset>-->
            <!--            <div class="form-group">-->
            <!--                <input class="form-control" placeholder="E-mail" name="email" type="text" autocomplete="off">-->
            <!--            </div>-->
            <!--            <div class="form-group">-->
            <!--                <input class="form-control" placeholder="Password" name="password" type="password" autocomplete="off">-->
            <!--            </div>-->
            <!--            <button type="submit" class="btn btn-lg btncolor btn-block">Log In</button>-->
            <!--        </fieldset>-->
            <!--        <br>-->
            <!--        <p class="small"><a href="forgotpass.php">Forgot your password?</a></p>-->
            <!--    </form>-->
            <!--    <?php if (isset($error_message)): ?>-->
            <!--        <div class="alert-container" id="alert-container">-->
            <!--            <div class="alert-box">-->
            <!--                <span class="alert-message"><?php echo $error_message; ?></span>-->
            <!--                <button class="alert-close" onclick="hideAlert()">&times;</button>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    <?php endif; ?>-->
            <!--</div>-->
             <div class=" col-lg-12 " >
                <div  id="items">
                <div class = "bgbox">
                    <div class="login-banner text-center satimgg">

                        <!-- <h1><i class="fa fa-gears"></i> Admin Login</h1> -->
                        <div class="d-flex justify-content-center ">

                            <img src="img/logomithra2.png" width="350" alt="" class="img-fluid">
                        </div>

                    </div>



                    <div class="portlet-body">
                        <form method="POST" action="" accept-charset="UTF-8" role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="text" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" autocomplete="off">
                                </div>
                                <div class="checkbox">
                                    <label class="remcolr">
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-lg btncolor btn-block" value="Sign IN">Log In</button>
                            </fieldset>
                            <br>
                            <p class="small">
                                <a href="forgotpass.php">Forgot your password?</a>
                            </p>
                        </form>

                    </div>
                </div>
                </div>
               



            </div>
        </div>
    </div>
    <script>
        function hideAlert() { document.getElementById("alert-container").style.display = "none"; }
    </script>
</body>
</html>
