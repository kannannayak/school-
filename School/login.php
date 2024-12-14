<?php include("include/conn.php"); ?>
<?php
session_start();

if (isset($_SESSION['school_name'])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $sql2 = "SELECT * FROM  `school_list` 
 
    WHERE `school_email` ='$email' AND  `school_pass` ='$password'";
    $result2 = mysqli_query($conn, $sql2);





    if (mysqli_num_rows($result2) == 1) {

        $vendor = mysqli_fetch_assoc($result2);
        $_SESSION['school_name'] = $vendor['school_name'];
        $_SESSION['school_id'] = $vendor['school_id'];



        header("Location: index.php");
    } else {
        $error_message = "Invalid email or password.";
        echo '<div class="alert-container" id="alert-container">
        <div class="alert-box" id="alert-box">
            <span class="alert-message" id="alert-message"></span>
            <button class="alert-close" id="alert-close">&times;</button>
        </div>
    </div>
    ';
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
        <div class="row">
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
    </div>
    <!-- GLOBAL SCRIPTS -->
    <script src="../../ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="js/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- HISRC Retina Images -->
    <script src="js/plugins/hisrc/hisrc.js"></script>
    <!-- THEME SCRIPTS -->
    <script src="js/flex.js"></script>
    <script>
        // Get the alert container, box, message, and close button elements
        var alertContainer = document.getElementById("alert-container");
        var alertBox = document.getElementById("alert-box");
        var alertMessage = document.getElementById("alert-message");
        var alertClose = document.getElementById("alert-close");

        // Function to show the alert popup with a message
        function showAlert(message) {
            // Set the message text
            alertMessage.textContent = message;
            // Display the alert container
            alertContainer.style.display = "block";
        }
        // Function to hide the alert popup
        function hideAlert() {
            // Hide the alert container
            alertContainer.style.display = "none";
        }
        // Add event listener to close button
        alertClose.addEventListener("click", function() {
            hideAlert();
        });


        showAlert("<?php echo $error_message; ?>");
    </script>
</body>

</html>